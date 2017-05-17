#include "DualVNH5019MotorShield.h"
#include<string.h>

const byte numChars = 32;
char receivedChars[numChars];
DualVNH5019MotorShield md;




#define Kp .25 // experiment to determine this, start by something small that just makes your bot follow the line at a slow speed
#define Kd .75// experiment to determine this, slowly increase the speeds and adjust this value. ( Note: Kp < Kd) 
#define rightMaxSpeed 400 // max speed of the robot
#define leftMaxSpeed 400 // max speed of the robot
#define rightBaseSpeed 120 // this is the speed at which the motors should spin when the robot is perfectly on the line
#define leftBaseSpeed 105  // this is the speed at which the motors should spin when the robot is perfectly on the line
//100,85
int error = 0;
int lastError = 0;
int rightMotorSpeed = rightBaseSpeed;
int leftMotorSpeed = leftBaseSpeed;
boolean newData = false;

void setup() {
  Serial.begin(9600);
}

void loop() {
    recvWithStartEndMarkers();
    showNewData();    
}

void recvWithStartEndMarkers() {
    static boolean recvInProgress = false;
    static byte ndx = 0;
    char rc;
 
    while (Serial.available() > 0 && newData == false) {
        rc = Serial.read();
        if(rc == 0){
          receivedChars[ndx] = '\0'; // terminate the string
          ndx = 0;
          newData = true;
             
        }else{
          receivedChars[ndx] = rc;
          ndx++;
          if (ndx >= numChars) {
              ndx = numChars - 1;
          }
        }
    }
}

void showNewData() {
    if (newData == true){
    
        error = atoi(receivedChars);
        int motorSpeed = (Kp * error) + Kp * (Kd * abs(error - lastError));
        lastError = error;

       
    
        int rightMotorSpeed = rightBaseSpeed + motorSpeed;
        int leftMotorSpeed = leftBaseSpeed - motorSpeed;
    
        if (rightMotorSpeed > rightMaxSpeed ) rightMotorSpeed = rightMaxSpeed; // prevent the motor from going beyond max speed
        if (leftMotorSpeed > leftMaxSpeed ) leftMotorSpeed = leftMaxSpeed; // prevent the motor from going beyond max speed
        if (rightMotorSpeed < 0) rightMotorSpeed = 0; // keep the motor speed positive
        if (leftMotorSpeed < 0) leftMotorSpeed = 0; // keep the motor speed positive
    
      /*  Serial.print("Error: ");
        Serial.print(error);
        Serial.print(" motorSpeed: ");
        Serial.print(motorSpeed);
        Serial.print(" left: ");
        Serial.print(leftMotorSpeed);
        Serial.print(" right: ");
        Serial.println(rightMotorSpeed);
    */
  
      md.setM1Speed(rightMotorSpeed);
      md.setM2Speed(leftMotorSpeed);
        
        newData = false;
    }
}
