###
# The first version of the robot program that will include the image processing
# and the radio frequency communication in one file with no threading
# Written by: Eyob Gemechu
import sys
sys.path.append('/usr/local/lib/python3.4/site-packages')
sys.path.append('/usr/local/lib/python2.7/site-packages')
import time
import spidev
import numpy as np
import cv2
from picamera.array import PiRGBArray
from picamera import PiCamera
import serial

ser = serial.Serial('/dev/ttyUSB0',
                    baudrate = 9600,\
                    parity = serial.PARITY_NONE,\
                    stopbits = serial.STOPBITS_ONE,\
                    bytesize = serial.EIGHTBITS,\
                    timeout = 0)
print(ser.name)

#####Initilize the camera######
width = 400
height = 400
mid = int(width/2)
camera = PiCamera()
camera.resolution = (width,height)
camera.framerate = 32
rawCapture = PiRGBArray(camera, size=(width,height))
bLower = np.array([100,100,100]) #blue lower
bUpper = np.array([130,255,255]) #blue upper
rLower = np.array([169,100,100]) #red lower
rUpper = np.array([189,255,255]) #red upper
###############################

time.sleep(0.1)


for frame in camera.capture_continuous(rawCapture, format="bgr", use_video_port=True):
    img1 = frame.array
    hsv = cv2.cvtColor(img1, cv2.COLOR_BGR2HSV)
    mask = cv2.inRange(hsv, bLower, bUpper)
    mask = cv2.erode(mask, None, iterations=2)
    mask = cv2.dilate(mask,None, iterations=2)
    mask2 = cv2.inRange(hsv, rLower, rUpper)
    mask2 = cv2.erode(mask, None, iterations=2)
    mask2 = cv2.dilate(mask, None, iterations=2)
    
    _,contours,hierarchy=cv2.findContours(mask,1,cv2.CHAIN_APPROX_NONE)

    _,contours2,hierarchy2=cv2.findContours(mask2,1,cv2.CHAIN_APPROX_NONE)
#    if len(contours) == 0:
 #       error = 600
  #      print("the error is "+str(error)+"\n")
   #     ser.write(str(error).encode('ascii')+"\0".encode('ascii'))
    #    time.sleep(.1)

    if len(contours2)> 0:
      cnt = max(contours2, key=cv2.contourArea)
      M = cv2.moments(cnt)
      if(M['m00'] > 500):
        error = 999
        print("Found some o dat red shit")
        ser.write(str(error).encode('ascii')+"\0".encode('ascii'))
        time.sleep(.1)	 
      elif len(contours)> 0:
        print("Found some o dat blue shit")
        cnt = max(contours, key=cv2.contourArea)
        M = cv2.moments(cnt)
        cx = int(M['m10']/M['m00'])
        # cy = int(M['m01']/M['m00'])
        # cv2.line(img1,(cx,0),(cx,height),(0,0,255),1)
        # cv2.line(img1,(mid,0),(mid,height),(0,255,255),1)
        # cv2.line(img1,(0,cy),(width,cy),(0,0,255),1)
        # cv2.drawContours(img1,contours,-1,(0,255,0),3)
        #print(cx)
        #command = "250"        
        error = mid-cx
        print("mid is at "+str(mid)+" cx is at "+str(cx)+" and the error is "+str(error)+"\n")
        ser.write(str(error).encode('ascii')+"\0".encode('ascii'))
        time.sleep(.1)
      else:
        error = 999
        print("I don't see shit")
        ser.write(str(error).encode('ascii')+"\0".encode('ascii'))
        time.sleep(.1)	 
     
	
      
    

#    cv2.imshow('frame',img1) #show video
 #   key = cv2.waitKey(1) & 0xFF
    rawCapture.truncate(0)

  #  if key == ord("q"):
   #     break  




