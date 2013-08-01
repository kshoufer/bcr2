/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function validateField(fieldId, fieldBoxId, fieldType, required)
{
    fieldBox = document.getElementById(fieldBoxId);
    fieldObj = document.getElementById(fieldId);

    if(fieldType == 'text'  ||  fieldType == 'textarea'  ||  fieldType == 'password'  ||  fieldType == fieldType == 'phone'  || fieldType == 'website')
    {	
            if(required == 1 && fieldObj.value == '')
            {
                    fieldObj.setAttribute("class","mainFormError");
                    fieldObj.setAttribute("className","mainFormError");
                    fieldObj.focus();
                    return false;					
            }
            else    
                {
                    fieldObj.setAttribute("class","mainForm");
                    fieldObj.setAttribute("className","mainForm");
                    fieldObj.focus();
                    //return true;
                }

    }//end if(fieldType == 'text'  ||...)

    else if(fieldType == 'file')
    {	
            var fileStr = fieldObj.value;
            var ext = fileStr.substring(fileStr.lastIndexOf('.') + 1);

            if(required == 1 && fieldObj.value == '')
            {
                    fieldObj.setAttribute("class","mainFormError");
                    fieldObj.setAttribute("className","mainFormError");
                    fieldObj.focus();                                               
                    return false;					
            }// end  if(required...)
            else
            {

               if(ext =="GIF" || ext=="gif" || ext=="JPEG" || ext=="jpeg" || ext=="JPG" || ext=="jpg" || ext=="png" || ext=="PNG" || fieldObj.value == '')
              {
                fieldObj.setAttribute("class","mainForm");
                fieldObj.setAttribute("className","mainForm");
                fieldObj.focus();                                            
                return true;
              }// end if(ext == "GIF"...)
              else
              {
                fieldObj.setAttribute("class","mainFormError");
                fieldObj.setAttribute("className","mainFormError");
                fieldObj.focus();
                return false;
              }// end else


                fieldObj.setAttribute("class","mainForm");
                fieldObj.setAttribute("className","mainForm");
                fieldObj.focus();
                return true;
            }// end else

    }// end else if(fieldType == 'file')





    else if(fieldType == 'menu'  || fieldType == 'country'  || fieldType == 'state')
    {	
            if(required == 1 && fieldObj.selectedIndex == 0 && fieldObj.value == 'Select State' )
            {				
                    fieldObj.setAttribute("class","mainFormError");
                    fieldObj.setAttribute("className","mainFormError");
                    fieldObj.focus();
                    return false;					
            }
            else
            {
                fieldObj.setAttribute("class","mainForm");
                fieldObj.setAttribute("className","mainForm");
                fieldObj.focus();
                //return true;
            }


    }


    else if(fieldType == 'email')
    {	
            if((required == 1 && fieldObj.value=='')  ||  (fieldObj.value!=''  && !validate_email(fieldObj.value)))
            {				
                    fieldObj.setAttribute("class","mainFormError");
                    fieldObj.setAttribute("className","mainFormError");
                    fieldObj.focus();
                    return false;					
            }
            else
            {
                fieldObj.setAttribute("class","mainForm");
                fieldObj.setAttribute("className","mainForm");
                fieldObj.focus();
                //return true;
            }


    }

    else if(fieldType == 'hidden' && fieldId == 'field_hpot')
    {	
            if(!fieldObj.value=='')
            {				
                    return false;					
            }
    }



}


function validate_email(emailStr)
{		
    apos=emailStr.indexOf("@");
    dotpos=emailStr.lastIndexOf(".");

    if (apos<1||dotpos-apos<2) 
    {
            return false;
    }
    else
    {
            return true;
    }
}


function validateDate(fieldId, fieldBoxId, fieldType, required,  minDateStr, maxDateStr)
{
    retValue = true;

    fieldBox = document.getElementById(fieldBoxId);
    fieldObj = document.getElementById(fieldId);	
    dateStr = fieldObj.value;


    if(required == 0  && dateStr == '')
    {
            return true;
    }


    if(dateStr.charAt(2) != '/'  || dateStr.charAt(5) != '/' || dateStr.length != 10)
    {
            retValue = false;
    }	

    else	// format's okay; check max, min
    {
            currDays = parseInt(dateStr.substr(0,2),10) + parseInt(dateStr.substr(3,2),10)*30  + parseInt(dateStr.substr(6,4),10)*365;
            //alert(currDays);

            if(maxDateStr != '')
            {
                    maxDays = parseInt(maxDateStr.substr(0,2),10) + parseInt(maxDateStr.substr(3,2),10)*30  + parseInt(maxDateStr.substr(6,4),10)*365;
                    //alert(maxDays);
                    if(currDays > maxDays)
                            retValue = false;
            }

            if(minDateStr != '')
            {
                    minDays = parseInt(minDateStr.substr(0,2),10) + parseInt(minDateStr.substr(3,2),10)*30  + parseInt(minDateStr.substr(6,4),10)*365;
                    //alert(minDays);
                    if(currDays < minDays)
                            retValue = false;
            }
    }

    if(retValue == false)
    {
            fieldObj.setAttribute("class","mainFormError");
            fieldObj.setAttribute("className","mainFormError");
            fieldObj.focus();
            return false;
    }
    else
    {
            fieldObj.setAttribute("class","mainForm");
            fieldObj.setAttribute("className","mainForm");
            fieldObj.focus();
            //return true;
     }

}




function validatePage1()             
        {                 
            retVal = true;                 
            if (validateField('field_title','fieldBox_title','text',1) == false)  
                retVal=false;             
            //if (validateField('field_GPS','fieldBox_GPS','text',0) == false)  
                //retVal=false; 
            if (validateField('field_location','fieldBox_location','text',1) == false)  
                retVal=false; 
            //if (validateField('field_category','fieldBox_category','menu',1) == false)  
                //retVal=false; 
            if (validateField('field_tags','fieldBox_tags','text',1) == false)  
                retVal=false; 
            if (validateField('field_condition','fieldBox_condition','text',1) == false)  
                retVal=false; 
            if (validateDate('field_date','fieldBox_date','date',1,'','') == false)  
                retVal=false; 
            if (validateField('field_description','fieldBox_description','textarea',1) == false)  
                retVal=false; 
            //if (validateField('field_country','fieldBox_country','country',1) == false)  
                //retVal=false; 
            if (validateField('field_state','fieldBox_state','state',1) == false)  
                retVal=false; 
            if (validateField('field_upload','fieldBox_upload','file',0) == false)  
                retVal=false;                 
            if (validateField('field_hpot','field_hpot','hidden',0) == false)  
                retVal=false;                 

            if(retVal == false) {                     
            alert('Please correct the errors.\nFields marked with an asterisk (*) are required');                     
            return false;
            
        }
        else {
        alert("Thank you for your submission!\nYour report will be available after review.");
        }                 
        return retVal;             }

