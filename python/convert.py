import os
import sys
reload(sys)

sys.path.append("/usr/lib/python2.7/site-packages/")
##video codec
try:
    from ffmpy import FFmpeg
except:
    print "no module named FFmpeg"

path = "/home/crystal/MG/reference/python/video/test/2.avi"
# ff = FFmpeg(
#     inputs = {"22.avi":None},
#     outputs = {"output2.mp4" : None}
# )
#
# ff.run()
# #

ff = FFmpeg(inputs={'%s'%path: None}, outputs={"output.png": ['-ss', '00:00:10', '-vframes', '1']})

print ff.cmd

ff.run()