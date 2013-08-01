/* 
 * This code validates the form fields
 * Author: Ken Shoufer
 */

/* expand/collapse function */

function collapseElem(obj)
        {
            var el = document.getElementById(obj);
            el.style.display = 'none';
        }


        function expandElem(obj)
        {
            var el = document.getElementById(obj);
            el.style.display = '';
        }

// collapse all elements, except the first one
            function collapseAll()
            {
                var numFormPages = 1;

                for(i=2; i <= numFormPages; i++)
                {
                    currPageId = ('mainForm_' + i);
                    collapseElem(currPageId);
                }
            }



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

                                }//kenshoufer

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
					}
                                        else
                                        {

                                           if(ext =="GIF" || ext=="gif" || ext=="JPEG" || ext=="jpeg" || ext=="JPG" || ext=="jpg" || ext=="png" || ext=="PNG" || fieldObj.value == '')
                                          {
                                            fieldObj.setAttribute("class","mainForm");
    				            fieldObj.setAttribute("className","mainForm");
					    fieldObj.focus();                                            
                                            return true;
                                          }
                                          else
                                          {
                                            fieldObj.setAttribute("class","mainFormError");
    				            fieldObj.setAttribute("className","mainFormError");
					    fieldObj.focus();
                                            return false;
                                          }


                                            fieldObj.setAttribute("class","mainForm");
    				            fieldObj.setAttribute("className","mainForm");
					    fieldObj.focus();
                                            return true;
                                        }


                                        
					

				}
                                        

				


				else if(fieldType == 'menu'  || fieldType == 'country'  || fieldType == 'state')
				{	
					if(required == 1 && fieldObj.selectedIndex == 0)
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

