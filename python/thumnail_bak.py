#-*- coding:utf-8 -*-
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
sys.path.append('/usr/lib/python2.7/site-packages/')

import os

from datetime import datetime

try:
    import MySQLdb
except:
    print "no module named mysqldb"

try:
    from ffvideo import VideoStream
except:
    print "no module named ffvideo"

import uuid

db = MySQLdb.connect(host="localhost", user="root", passwd="macro_Adm1n", db="reference_library", charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")

db.query("set character_set_results=utf8;")
db.query("set character_set_database=utf8;")


#path = "/DATA/reference/movie/west/[1972]대부1.MarioPuzo\'sTheGodfatherI"

path = sys.argv[1]


def search(dirname):
    try:
        filenames = os.listdir(dirname)
        for filename in filenames:
            if dirname[-1] == "/":
                pass
            else:
                dirname = dirname+"/"
            full_path = os.path.join(dirname,filename)
            if os.path.isdir(full_path):
                search(full_path)
            else :
                ext = os.path.splitext(full_path)[-1]
                thum = "%s_" %(datetime.today().strftime('%Y%m%d')) + str(uuid.uuid4())[:8] + ".jpg"
                small_thum_path = "/DATA/reference_library/thumnail/small_thum/%s" %thum

                if ext.lower() == ".mp4" or ext.lower() == ".mov" or ext.lower() == ".mkv" or ext.lower() == ".avi":

                    try:
                        thumbnail = VideoStream(full_path).get_frame_at_sec(1).image()
                        thumbnail.save(small_thum_path)
			
			full_path = full_path[5:]


			select_query = "select * from img where full_path = '%s'"%full_path
			cur.execute("set names utf8")
			cur.execute(select_query)
			if cur.rowcount == 0:
                            query = "insert into img(img_path,img_name,full_path,thumnail,type) values('%s','%s','%s','%s','%s')" % (
                            dirname, filename, full_path, thum, 'video')
                            cur.execute("set names utf8")
                            cur.execute(query)
                            db.commit()
			else:
			    pass

                    except Exception,e:
                        print e

                else:
                    pass

    except Exception,e:
        print e

search(path)
