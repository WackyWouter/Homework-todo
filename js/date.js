window.onload = function(){
    var currentDateHtml = this.document.getElementById("currentDate");
    var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var today = new Date();
    var dd = today.getDate();
    var day = daysOfWeek[today.getDay()];
    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();

    if(dd < 10) 
    {
        dd = '0' + dd;
    } 

    if(mm < 10) 
    {
        mm = '0' + mm;
    } 
    today = day + ' ' + dd + '-' + mm + '-' + yyyy;
    currentDateHtml.innerHTML = today;
}