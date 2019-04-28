function checkActivity(){
	$.post("index.php",
    {
        check_user_activity: true
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
    });
}
