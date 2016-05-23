 function act(id,msg,type) 
 {

    var idname = '#' + id;
    var errorid = '#' + id + type;
     var input='';

       var error;
        var pos = $(idname).parent().offset();
        var errortop = pos.top;

        errortop = errortop - 9;
        var errorleft = pos.left;
        errorleft = errorleft;
        input = $(idname).val();

        var alt = $(idname).attr('alt');        
        var filter = "";
	   if(input=="A0")
        {
        if(type=='S')
        {
        error=true;
        }
		}
		if(type=='blank')
		{
      	 if (input == '')
           error = true;
         }

     if (type=='pw'){

         var pwd=$("#pwd").val();

         if (pwd!=input)
             error = true;
     }

     if(type=='check')
     {
         var isChecked = $(idname).is(':checked');
         if(!isChecked)
         {
             error = true;
         }
     }

     else if(type=='P')
       {
		
       if(input==alt)
       {
		   
         error=true;
       }
    }
	 else  if (type =='K')
                 {
              
                      filter  = /^[0-9]+$/;
                      if ((filter.test(input)) == false)
                          error = true;
       
                 }
				 
				  else  if (type =='OR')
                 {
					 var sinput=id.split("1");
					 var sinput2=sinput[0];
					 if(id==sinput2)
					 {
						
						 var oinput=$("#card").val();
						 var oalt=$("#card").attr('alt');
						 
						if(input==alt &&  oinput==oalt )
       					{
							
		           			 error=true;
      					}
						 
					 }
					 else
					 {
						 var oinput=$("#card1").val();
						 var oalt=$("#card1").attr('alt');
						 
						if(input==alt && oinput==oalt )
       					{
		           			 error=true;
      					}
						
						 
					 }
              
                      
       
                 }
	else  if (type =='J') {
            if (input == '') {
                error = true;
            }
            else {
                filter = /^\d{10}$/;
                if ((filter.test(input)) == false)

                    error = true;
            }

  	  }

     else  if (type =='SEL') {
         if (input == '-Select-') {
             error = true;
         }


     }

        else if(type=='SE')
        {

            var input2=$(".btn-group").children("button").children("span").html();

            if(input2=='None selected')
            {
                error=true;
            }
            else
            {
                error=false;
            }

        }

     else if(type=='D')
     {

       var filter=  /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/;

         if ((filter.test(input)) == false)
             error = true;


     }

     
	  else if (type=='E'){

                    filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if ((filter.test(input)) == false)
                        error = true;
                    }

        else if (type=='E2'){

if(input!='') {
    filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if ((filter.test(input)) == false)
        error = true;

}
            else
{
    error = true;
}
        }




        if (error == true ) {

            $(idname).parent().append('<div id="' + id + type + '"/>');
            $(errorid).html('*' + msg);
            $(errorid).addClass('error');
            //$(errorid).css("top", Math.max(errortop - $(errorid).scrollTop()));
            //$(errorid).css('top', errortop);
            //$(errorid).css('left', errorleft);
            $(errorid).css('display', 'block');
        }
		
        else {

            $(errorid).html('');
            $(errorid ).remove();
            $(errorid).css('display', 'none');

        }
        return error;
    }