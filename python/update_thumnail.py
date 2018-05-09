# -*- coding:utf-8 -*-
import sys

reload(sys)
sys.setdefaultencoding('utf-8')
sys.path.append('/usr/lib/python2.7/site-packages/')

import os

import subprocess

import commands

from datetime import datetime

try:
    import MySQLdb
except:
    print "no module named mysqldb"

try:
    from ffvideo import VideoStream
except:
    print "no module named ffvideo"

try:
    from wand.image import Image
except:
    print "no module named wand.image"

import uuid

db = MySQLdb.connect(host="mgpipe.mg.com", user="root", passwd="macro_Adm1n", db="reference_library",
                     charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")

db.query("set character_set_results=utf8;")
db.query("set character_set_database=utf8;")

# path = sys.argv[1]

path ="/DATA/reference/tutor/"

def search(dirname):
    try:
        filenames = os.listdir(dirname)
        for filename in filenames:
            if dirname[-1] == "/":
                pass
            else:
                dirname = dirname + "/"
            full_path = os.path.join(dirname, filename)
            if os.path.isdir(full_path):
                search(full_path)
            else:

                ext = os.path.splitext(full_path)[-1]
                thum = "%s_" % (datetime.today().strftime('%Y%m%d')) + str(uuid.uuid4())[:8] + ".jpg"
                small_thum_path = "/DATA/reference_library/thumnail/small_thum/%s" % thum

                if ext.lower() == ".mp4" or ext.lower() == ".mov" or ext.lower() == ".mkv" or ext.lower() == ".avi" or ext.lower() == ".webm":

                    try:
                        duration = int(VideoStream(full_path).duration/2)
                        thumbnail = VideoStream(full_path).get_frame_at_sec(duration).image()
                        thumbnail.save(small_thum_path)
                        print full_path
                    except Exception, e:
                        print e

                    try:
                        codec = VideoStream(full_path).codec_name
                        if codec == "h264" or codec == "aac":
                            full_path = full_path[5:]
                            query_o = 'update img set thumnail="%s" where full_path="%s"'%(thum,full_path)

                            cur.execute("set names utf8")
                            cur.execute(query_o)
                            db.commit()

                        else:
                            full_path = full_path[5:]
                            query = 'update img set thumnail="codec.png" where full_path="%s"'%full_path

                            cur.execute("set names utf8")
                            cur.execute(query)
                            db.commit()

                    except Exception, e:
                        pass

                else:

                    try:
                        with Image(filename=full_path) as img:
                            if img.width < 400 or img.height < 400:
                                # pass
                                img.save(filename=small_thum_path)
                            else:
                                if (img.width > img.height):
                                    small_thum = img.transform(resize="300x")
                                elif (img.width < img.height):
                                    small_thum = img.transform(resize="x300")
                                else:
                                    small_thum = img.transform(resize="300x300")

                                img.save(small_thum, filename=small_thum_path)

                    except Exception, e:
                        print e

                    full_path = full_path[5:]

                    query = 'update img set thumnail="%s" where full_path="%s"'%(thum,full_path)
                    cur.execute("set names utf8")
                    cur.execute(query)
                    db.commit()


    except Exception, e:
        print e


search(path)

