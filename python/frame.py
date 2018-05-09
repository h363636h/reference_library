# -*- coding:utf-8 -*-
import sys
import subprocess

reload(sys)
sys.setdefaultencoding('utf-8')
sys.path.append('/usr/lib/python2.7/site-packages/')

import os


# audio_codec = os.system("../ffmpeg-git-20171128-64bit-static/ffprobe -v quiet -show_streams -select_streams a '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' | grep 'codec_name='")
# print str(audio_codec).


audio_codec = subprocess.check_output("../ffmpeg-git-20171128-64bit-static/ffprobe -v quiet -show_streams -select_streams a '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' | grep 'codec_name='",shell=True)
audio_codec = audio_codec.split("=")[1]
if audio_codec == "aac":
	pass
else:
	print "o"

# cmd = "../ffmpeg-git-20171128-64bit-static/ffprobe -v quiet -show_streams -select_streams a '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' | grep 'codec_name='"
# audio_codec = subprocess.Popen([cmd],stdout=subprocess.PIPE,shell=True)
# out = audio_codec.stdout.read()
# print out

# os.system("../ffmpeg-git-20171128-64bit-static/ffprobe -v quiet -show_streams -i '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' | grep 'codec_name'")


# os.system("../ffmpeg -i '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' -map single_highest_quality_audio_stream_from_all_inputs")



# result = subprocess.Popen("../ffprobe -i '/DATA/reference/ani/[2009]메리와 맥스 Mary.And.Max/Mary.And.Max 2009.720p.BRRip.XviD-Power.mkv' -show_entries format=duration -v quiet -of csv='p=0'", stdout=subprocess.PIPE,stderr=subprocess.STDOUT)
# output = result.communicate()
# print output[0]