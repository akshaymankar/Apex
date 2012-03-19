var xhr=new XMLHttpRequest();
var xhr_ps_file=new XMLHttpRequest();
var res_ready=false;
function check_op(opid)
{
    xhr.open("post","check_op.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    param="opid="+opid;

    xhr.onreadystatechange = function() {
        if(xhr.status==200 && xhr.readyState==4){
            var res = xhr.responseText;
            if (res==1) {
                alert("Result is Ready..!!");
                window.location="../viewer/index.php";
                res_ready=true;
                
                //call chebozoom
                
                xhr_ps_file.open("get","getps.php");

                xhr_ps_file.onreadystatechange = function() {
                    if (xhr.status==200 && xhr.readyState==4) {
                        var res=xhr.responseText;
                        if (res!=0) {
                            param="filename="+res;
                            window.location = "../viewer/index.php?"+param;
                        }
                    }
                }
            }
        }
    }
    if(!res_ready) {
        xhr.send(param);
        setTimeout("check_op("+opid+")",3000);
    }
}
