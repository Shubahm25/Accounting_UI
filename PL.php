 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>P&L</title>  
		   <link rel="icon"  href="download.ico" />
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>  
           <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>  
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
      </head> 


<style>
#cat {
  font-size: 120%;
  font-weight: 900;
  
}
#cat1{
  
  padding-left:50px;
  
}


#cat3{
  
  padding-left:80px;
  
}

#cat5
{
padding-:50px;
}

#cat2
{
	background-color:#f5f5f5  !important;
}


p{
	
text-align:center;
font-weight: 900;	
}

#li {
  border-left: 1px solid black;
  border-top: 4px solid black;
   border-right: 4px solid black;
   border-bottom: 4px solid black;
 width: 50%;
  height: 50%;
}

#li2 {
  border-left: 4px solid black;
  border-top: 4px solid black;
   border-right: 2px solid black;
   border-bottom: 4px solid black;
  width: 50%;
  height:50%;
}

#opt {
 
  border-bottom: 3px solid black;
   
   
  width: 100px;
 
}


#cat4{
	border-top: 3px solid black;
   
   
  width: 100px;
  
  background-color:#f5f5f5  !important;
}

</style	>
      <body>  
           <br /><br />  
		   
		   
		   
		 <h2>  <p> Profit & Loss Account</p></h2>
		   
		   </br>
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

<br>
<br>
<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  


				
		
<br>
<br>	



<div class="row">
		
<div class="col-xs-6" id="li2">	
<div class="table-responsive" id="data">

</div>

</div>

<div class="col-xs-6" id="li">		
<div class="table-responsive" id ="data1">

</div>

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
          url: 'http://localhost:7657/accounting/getProfitAndLoss?fromDate=1568885689000&toDate='+d,
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

var tbody='<table class="table table-striped"><thead><tr id="opt"> <th>Particulars</th><th >Amount</th></tr><tbody>'
var tbody1='<table class="table table-striped"><thead><tr id="opt"> <th >Particulars</th><th >Amount</th></tr><tbody>'

var debitUpper=data["data"]["debitDto"]["debitUpper"];


console.log(debitUpper);


var headlist=[];
var grouplist=[];

var ledgerlist=[];
if(debitUpper!=null)
{
for(var i=0;i< debitUpper.length;i++)
{
headlist=debitUpper[i]["headsList"];

if(typeof headlist !== 'undefined')

{
for(var j=0;j< headlist.length;j++)
{


tbody+='<tr><td id="cat">';
tbody+=headlist[j]["name"];
tbody+='</td>';
tbody+='<td id="cat">'
tbody+=headlist[j]["total"];
tbody+='</td>';
tbody+='</tr>';

grouplist=headlist[j]["groupList"];

if(typeof grouplist !== 'undefined' || grouplist !=null)

{
for(var k=0;k< grouplist.length;k++)
{


tbody+='<tr><td id="cat1">';
tbody+=grouplist[k]["name"];
tbody+='</td >';
tbody+='<td>'
tbody+=grouplist[k]["amount"];
tbody+='</td>';
tbody+='</tr>';

ledgerlist=grouplist[k]["debitUperLedgerList"];
if(typeof ledgerlist !== 'undefined')
{
for(var l=0;l< ledgerlist.length;l++)
{

tbody+='<tr><td id="cat3">';
tbody+=ledgerlist[l]["name"];
tbody+='</td>';
tbody+='<td id="cat5">'
tbody+=ledgerlist[l]["amount"];
tbody+='</td>';
tbody+='</tr>';

}



}



}


}


}

}







grossprofit=debitUpper[i]["grossProfit"];
if(typeof grossprofit !== 'undefined')
{

tbody+='<tr><td id="cat">';
tbody+=grossprofit["name"];
tbody+='</td >';
tbody+='<td id="cat">'
tbody+=grossprofit["total"];
tbody+='</td>';
tbody+='</tr>';

}


Total=debitUpper[i]["total"];
if(typeof Total !== 'undefined')
{

tbody+='<tr><td id="cat">';
tbody+='Total';
tbody+='</td >';
tbody+='<td id="cat">'
tbody+=Total;
tbody+='</td>';
tbody+='</tr>';

}

}


}








var debitUpper=data["data"]["debitDto"]["debitLower"];


console.log(debitUpper);


var headlist=[];
var grouplist=[];

var ledgerlist=[];
if(debitUpper!=null)
{
for(var i=0;i< debitUpper.length;i++)
{
headlist=debitUpper[i]["headsList"];

if(typeof headlist !== 'undefined')

{
for(var j=0;j< headlist.length;j++)
{


tbody+='<tr><td id="cat">';
tbody+=headlist[j]["name"];
tbody+='</td>';
tbody+='<td id="cat">'
tbody+=headlist[j]["total"];
tbody+='</td>';
tbody+='</tr>';

grouplist=headlist[j]["groupList"];

if(typeof grouplist !== 'undefined')

{
for(var k=0;k< grouplist.length;k++)
{


tbody+='<tr><td id=cat1>';
tbody+=grouplist[k]["name"];
tbody+='</td>';
tbody+='<td>'
tbody+=grouplist[k]["amount"];
tbody+='</td>';
tbody+='</tr>';

ledgerlist=grouplist[k]["debitLowerLedgerList"];
if(typeof ledgerlist !== 'undefined')
{
for(var l=0;l< ledgerlist.length;l++)
{

tbody+='<tr><td id=cat3>';
tbody+=ledgerlist[l]["name"];
tbody+='</td>';
tbody+='<td>'
tbody+=ledgerlist[l]["amount"];
tbody+='</td>';
tbody+='</tr>';

}



}



}


}


}

}







grossprofit=debitUpper[i]["netProfit"];
if(typeof grossprofit !== 'undefined')
{

tbody+='<tr><td id="cat">';
tbody+=grossprofit["name"];
tbody+='</td>';
tbody+='<td id="cat">'
tbody+=grossprofit["total"];
tbody+='</td>';
tbody+='</tr>';

}

Total=debitUpper[i]["total"];
if(typeof Total !== 'undefined')
{

tbody+='<tr><td id="cat">';
tbody+='Total';
tbody+='</td>';
tbody+='<td id="cat">'
tbody+=Total;
tbody+='</td>';
tbody+='</tr>';

}


}


}








var CreditUpper=data["data"]["creditDto"]["creditUpperList"];


console.log(CreditUpper);

var headlist1=[];
var grouplist=[];

var ledgerlist=[];


if(CreditUpper !=null)
{
for(var i=0;i< CreditUpper.length;i++)
{
headlist1=CreditUpper[i]["headslist"];

if(typeof headlist1 !== 'undefined')

{
for(var j=0;j< headlist1.length;j++)
{


tbody1+='<tr><td id="cat">';
tbody1+=headlist1[j]["name"];
tbody1+='</td>';
tbody1+='<td id="cat">'
tbody1+=headlist1[j]["total"];
tbody1+='</td>';
tbody1+='</tr>';

grouplist=headlist1[j]["groupList"];

if(typeof grouplist !== 'undefined')

{
for(var k=0;k< grouplist.length;k++)
{


tbody1+='<tr><td id=cat1>';
tbody1+=grouplist[k]["name"];
tbody1+='</td>';
tbody1+='<td>'
tbody1+=grouplist[k]["amount"];
tbody1+='</td>';
tbody1+='</tr>';

ledgerlist=grouplist[k]["creditUperLedgerList"];
if(typeof ledgerlist !== 'undefined')
{
for(var l=0;l< ledgerlist.length;l++)
{

tbody1+='<tr><td id=cat3>';
tbody1+=ledgerlist[l]["name"];
tbody1+='</td>';
tbody1+='<td >'
tbody1+=ledgerlist[l]["amount"];
tbody1+='</td>';
tbody1+='</tr>';

}



}


}
}


}
}

Total=CreditUpper[i]["total"];
if(typeof Total !== 'undefined')
{

tbody1+='<tr><td id="cat">';
tbody1+='Total';
tbody1+='</td>';
tbody1+='<td id="cat">'
tbody1+=Total;
tbody1+='</td>';
tbody1+='</tr>';

}

}


}




var creditLower=data["data"]["creditDto"]["creditLowerList"];


console.log(creditLower);

var headlist1=[];
var grouplist=[];

var ledgerlist=[];


if(creditLower !=null)
{
for(var i=0;i< creditLower.length;i++)
{
headlist1=creditLower[i]["headsDto"];
if(headlist1 !=null)
{

if(typeof headlist1 !== 'undefined')

{
for(var j=0;j< headlist1.length;j++)
{

console.log(headlist1[j]["grossProfitLoss"]);


if(headlist1[j]["name"]!=null)
{
tbody1+='<tr><td id="cat">';
tbody1+=headlist1[j]["name"];
tbody1+='</td>';
tbody1+='<td id="cat">'
tbody1+=headlist1[j]["total"];
tbody1+='</td>';
tbody1+='</tr>';
}

grouplist=headlist1[j]["groupList"];

if(grouplist!=null)
{
if(typeof grouplist !== 'undefined')

{
for(var k=0;k< grouplist.length;k++)
{


tbody1+='<tr><td id="cat">';
tbody1+=grouplist[k]["name"];
tbody1+='</td>';
tbody1+='<td id="cat">'
tbody1+=grouplist[k]["amount"];
tbody1+='</td>';
tbody1+='</tr>';

ledgerlist=grouplist[k]["creditLowerLedgerList"];
if(typeof ledgerlist !== 'undefined')
{
for(var l=0;l< ledgerlist.length;l++)
{

tbody1+='<tr><td>';
tbody1+=ledgerlist[l]["name"];
tbody1+='</td>';
tbody1+='<td>'
tbody1+=ledgerlist[l]["amount"];
tbody1+='</td>';
tbody1+='</tr>';

}




}

}
}



}
}
}
}


grossprofit=creditLower[i]["grossProfit"];
if(typeof grossprofit !== 'undefined')
{

tbody1+='<tr><td id="cat">';
tbody1+=grossprofit["name"];
tbody1+='</td >';
tbody1+='<td id="cat">'
tbody1+=grossprofit["total"];
tbody1+='</td>';
tbody1+='</tr>';

}

Total=creditLower[i]["total"];
if(typeof Total !== 'undefined')
{

tbody1+='<tr><td id="cat">';
tbody1+='Total';
tbody1+='</td>';
tbody1+='<td id="cat">'
tbody1+=Total;
tbody1+='</td>';
tbody1+='</tr>';

}
}


}























      $('#data').html(tbody);
$('#data1').html(tbody1);
 

			
 },
         error: function() { alert('failure!'); }
         
        });
      
});













 









  
 </script>  
