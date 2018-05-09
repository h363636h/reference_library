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

db = MySQLdb.connect(host="mgpipe.mg.com", user="root", passwd="macro_Adm1n", db="reference_library", charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")

db.query("set character_set_results=utf8;")
db.query("set character_set_database=utf8;")


# path = "/DATA/reference/Documentary/[2007]식코 Sicko"
path = sys.argv[1]
print path
# path = '/DATA/reference/ani/'
path_arr = []

def search(dirname):
    try:
        filenames = os.listdir(dirname)
        for filename in filenames:
            if dirname[-1] == "/":
                pass
            else:
                dirname = dirname + "/"
            full_path = os.path.join(dirname, filename)
            if os.path.isdir(full_path) == False:
                # full_path = full_path[5:]
                path_arr.append(full_path)
            else:
                pass
    except Exception, e:
        print e
        pass

def delete(dirname):
    select_query = 'select * from img where img_path="%s"'%path
    cur.execute("set names utf8")
    cur.execute(select_query)
    results = cur.fetchall()
    # print results
    db_path_arr = []

    for i in results:
        db_path_arr.append(i[3])


    diff_arr = list(set(db_path_arr) - set(path_arr))

    for delete_path in diff_arr:
        delete_query = 'delete from img where full_path="%s"'%delete_path
        cur.execute(delete_query)
        db.commit()

def insert(dirname):
    select_query = 'select * from img where img_path="%s"'%path
    cur.execute("set names utf8")
    cur.execute(select_query)

    results = cur.fetchall()
    db_path_arr = []

    for i in results:
        db_path_arr.append(i[3])
    diff_arr = []

    for a in path_arr:
        if a not in db_path_arr:
            diff_arr.append(a)

    for full_path in diff_arr:

        ext = os.path.splitext(full_path)[-1]
        thum = "%s_" % (datetime.today().strftime('%Y%m%d')) + str(uuid.uuid4())[:8] + ".jpg"
        small_thum_path = "/DATA/reference_library/thumnail/small_thum/%s"%thum
        filename = os.path.split(full_path)[-1]

        if ext.lower() == ".mp4" or ext.lower() == ".mov" or ext.lower() == ".mkv" or ext.lower() == ".avi" or ext.lower() == ".webm":

            try:
                duration = int(VideoStream(full_path).duration/2)
                thumbnail = VideoStream(full_path).get_frame_at_sec(duration).image()
                thumbnail.save(small_thum_path)

            except Exception, e:
                print e

            select_query = 'select * from img where full_path = "%s"' % full_path[5:]
            cur.execute("set names utf8")
            cur.execute(select_query)

            if cur.rowcount == 0:
                try:
                    codec = VideoStream(full_path).codec_name
                    print codec
                    if codec == "h264" or codec =="aac":
                        full_path = full_path[5:]
                        query_o = 'insert into img(img_path,img_name,full_path,thumnail,type) values("%s","%s","%s","%s","%s")' % (path,filename,full_path,thum,'video')
                        # print query_o
                        cur.execute("set names utf8")
                        cur.execute(query_o)
                        db.commit()

                    else:
                        full_path = full_path[5:]
                        query = 'insert into img(img_path,img_name,full_path,thumnail,type) values("%s","%s","%s","%s","%s")'%(path,filename,full_path,'codec.png','video')
                        # print query
                        cur.execute("set names utf8")
                        cur.execute(query)
                        db.commit()

                except Exception,e:
                    pass
            else:
                pass
        elif ext.lower() == ".smi" or ext.lower() == ".db" or ext.lower() == ".nk" or ext.lower() == ".ma" or ext.lower() == ".mb" or ext.lower() == ".zip" or ext.lower() == ".rar" or ext.lower() == ".pdf" or ext.lower() == ".txt" or ext.lower() == ".lnk" or ext.lower() ==".nfo" or ext.lower() == ".srt" or ext.lower() == ".sub" or ext.lower() == ".idx" or ext.lower() == ".ass":
            pass
        else:

            try:
                with Image(filename=full_path) as img:
                    if img.width < 400 or img.height < 400:
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

            select_query = 'select * from img where full_path = "%s"' % full_path
            cur.execute("set names utf8")
            cur.execute(select_query)

            if cur.rowcount == 0:

                query = 'insert into img(img_path,img_name,full_path,thumnail,type) values("%s","%s","%s","%s","%s")' % (path, filename, full_path, thum,'img')
                cur.execute("set names utf8")
                cur.execute(query)
                db.commit()

            else:
                pass


search(path)
delete(path)
insert(path)



