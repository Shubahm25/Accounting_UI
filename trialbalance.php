 <!DOCTYPE html>
<html>
<title>TrialBalance</title>  
		   
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



<h2> <p>TrialBalance Sheet</p></h2> 
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
  
                                                                                      
  <div class="table-responsive" id="data">          

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
          url: 'http://localhost:7657/accounting/getTrialBalance?fromdate=1567189800000&todate='+d,
          type: 'GET',
          dataType: 'json',
		  crossDomain:true,
		  CrossOrigin:true,
		  
		   headers: {
                    'Access-Control-Allow-Origin': '*',
'tenantId' :1,
'userId':1
					

                },
          success: function(data) {
console.log(data);

if(data["responseCode"]=="0")
{

 var d=data["data"]["TrialBalance"]["categories"];



   var tbody = '<table class="table"><thead><tr><th>Particulars</th><th>Credit</th><th>Debit</th> </tr></thead><tbody>';
        
      
     
			
	var group = []; 
        var ledger=[];
if(d!=null)
{
for(var i=0;i <d.length;i++)
{
console.log(i)

tbody+='<tr><td id ="cat">';
tbody+=d[i]["name"];
tbody+='</td>';
tbody+='<td id="cat">'
tbody+=d[i]["credit"];
tbody+='</td>';
tbody+='<td id="cat">';
tbody+=d[i]["debit"];
tbody+='</td>';
tbody+='</tr>';

group=d[i]["group"];

console.log(d[i]["name"]);
console.log(d[i]["credit"]);
console.log(d[i]["debit"]);
if(typeof group !== 'undefined')
{
for(var j=0;j < group.length;j++)
{

tbody+='<tr><td id ="group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
tbody+=group[j]["name"];
tbody+='</td>';
tbody+='<td id="group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
if(group[j]["credit"]==0)
{
tbody+='-';
}
else
{
tbody+=group[j]["credit"];
}
tbody+='</td>';
tbody+='<td id="group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
if(group[j]["debit"]==0)
{
tbody+='-';
}
else
{
tbody+=group[j]["debit"];
}
tbody+='</td>';
tbody+='</tr>';

console.log(group[j]["name"]);

console.log(group[j]["credit"]);
console.log(group[j]["debit"]);

ledger=group[j]["ledger"];

if(typeof ledger !== 'undefined')
{
for(var k=0;k < ledger.length;k++)
{

tbody+='<tr id="data1"> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
tbody+=ledger[k]["name"];
tbody+='</td>';
tbody+='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
if(ledger[k]["credit"]==0)
{
tbody+='-'
}
else
{
tbody+=ledger[k]["credit"];
}
tbody+='</td>';
tbody+='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
if(ledger[k]["debit"]==0)
{
tbody+='-';
}
else
{
tbody+=ledger[k]["debit"];
}
tbody+='</td>';
tbody+='</tr>';


console.log(ledger[k]["name"]);
console.log(ledger[k]["credit"]);
console.log(ledger[k]["debit"]);
}
}
}
}





}

tbody+='<tr> <td id =grand>';
tbody+="Grand Total";
tbody+='</td>';
tbody+='<td id="grand">';


tbody+=data["data"]["TrialBalance"]["TotalCredit"];

tbody+='</td>';
tbody+='<td id="grand">';


tbody+=data["data"]["TrialBalance"]["TotalDebit"];

tbody+='</td>';
tbody+='</tr>';
tbody+='</tbody></table>'
$('#data').html(tbody);
}
}
else
{

alert('failure');
location.reload(true);
}










 

 
             
 },
         error: function() { alert('failure!'); }
         
        });
      
});













 









  
 </script>  
