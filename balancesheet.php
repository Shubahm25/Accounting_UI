 <!DOCTYPE html>
<html>

   <title>BalanceSheet</title>  
		   
<head>
<link rel="icon"  href="download.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
</head>

<style>



#grand{
  font-weight: 900;
font-size: 150%;
}
#cat{
 font-weight: 900;
font-size: 130%;


}
#cat3{
 font-weight: 900;
background-color:#f5f5f5  !important;
font-size: 130%;


}
#group
{
font-weight: 900;
font-size: 120%;
}

p{
text-align:center;
}

</style>

<body>



<h2> <p>Balance Sheet</p></h2> 
<div class="container">

<h2> <p>Links</p></h2>

<div class ="row">


<div class="col-xs-2">
<a href="balancesheet.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Balance Sheet</a>


</div>
<div class="col-xs-2">
<a href="LedgerView.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">LedgerView</a>



</div>
<div class="col-xs-2">
<a href="trialbalance.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Trial Balance</a>


</div>
<div class="col-xs-2">

<a href="PL.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">P&L</a>


</div>
<div class="col-xs-2">
<a href="Entry.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Entry</a>


</div>
</div>



  <div class="form-group">  
				
		
<br>
<br>	



  <div class="form-group">  
				
				
				
                     <form name="add_name" id="add_name">  
		
</br>							<div class="input-group date" data-provide="datepicker">
 <input type="text" class="form-control date-withicon" name="date" placeholder="Select Date"/>
 <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
<div>
</br>
<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  

</form>

</div>
  <div class="row">
    <div class="col-lg-6">
 <div class="table-responsive" id="data">          

  </div>

</div>
    <div class="col-lg-6">
<div class="table-responsive" id="dataw">          

  </div>
</div>
                                                                                      
  
</div>

</body>
</html>
 <script>  

$('#submit').click(function(){
var date=$("input[name='date']").val();
var d = Date.parse(date); 
console.log(d);
$.ajax({

          url: 'http://localhost:7657/accounting/getBalanceSheet?fromDate=1546281000000&toDate='+d,
          type: 'GET',
          dataType: 'json',
		  crossDomain:true,
		  CrossOrigin:true,
		  
		   headers: {
                    'Access-Control-Allow-Origin': '*',
'tenantId':1,
'userId':1
					

                },
          success: function(data) {


console.log(data);
 var tbody = '<table class="table"><thead><tr><th>Liabilities</th><th>Amount</th></tr></thead><tbody>';
var tbody1 = '<table class="table"><thead><tr><th>Assets</th> <th>Amount</th></tr></thead><tbody>';

var headlist= data["data"]["liabilitiesDto"]["headsList"];
var breakuplist=[]

if(headlist!=null)
{

console.log(headlist);	
for(var i=0;i<headlist.length;i++)
{

tbody+='<tr><td id ="cat">';
tbody+=headlist[i]["name"];
tbody+='</td>';
tbody+='<td id ="cat">'
tbody+=headlist[i]["total"];
tbody+='</td>';
tbody+='</tr>';

breakuplist=headlist[i]["breakupsList"];


if(typeof breakuplist !== 'undefined')
{
for(var j=0;j<breakuplist.length;j++)
{

tbody+='<tr><td id ="cat1">';
tbody+=breakuplist[j]["name"];
tbody+='</td>';
tbody+='<td>'
tbody+=breakuplist[j]["total"];
tbody+='</td>';
tbody+='</tr>';

}



}

}


tbody+='<tr> <td id =grand>';
tbody+=data["data"]["liabilitiesDto"]["netProfit"]["name"];
tbody+='</td>';
tbody+='<td id ="cat">';


tbody+=data["data"]["liabilitiesDto"]["netProfit"]["total"];;


tbody+='</tr>';



tbody+='<tr id ="cat3"> <td id =grand>';
tbody+="Total";
tbody+='</td>';
tbody+='<td>';


tbody+=data["data"]["liabilitiesDto"]["total"];


tbody+='</tr>';
tbody+='</tbody></table>'
$('#data').html(tbody);

}
var headlist1= data["data"]["assetsDto"]["headsList"];
var breakuplist1=[];

if(headlist1!=null)
{

for(var i=0;i<headlist1.length;i++)
{

tbody1+='<tr><td id ="cat">';
tbody1+=headlist1[i]["name"];
tbody1+='</td>';
tbody1+='<td id ="cat">'
tbody1+=headlist1[i]["total"];
tbody1+='</td>';
tbody1+='</tr>';

breakuplist1=headlist1[i]["breakupsList"];
if(typeof breakuplist1 !== 'undefined')
{
for(var j=0;j<breakuplist1.length;j++)
{

tbody1+='<tr><td id ="cat1">';
tbody1+=breakuplist1[j]["name"];
tbody1+='</td>';
tbody1+='<td>'
tbody1+=breakuplist1[j]["total"];
tbody1+='</td>';
tbody1+='</tr>';

}



}

}

tbody1+='<tr id ="cat3"> <td id =grand>';
tbody1+="Total";
tbody1+='</td>';
tbody1+='<td>';


tbody1+=data["data"]["assetsDto"]["total"];


tbody1+='</tr>';
tbody1+='</tbody></table>'

tbody1+='</tbody></table>'
$('#dataw').html(tbody1);

}




console.log();












 

 
             
 },
         error: function() { alert('failure!'); }
         
        });
      
});













 









  
 </script>  
