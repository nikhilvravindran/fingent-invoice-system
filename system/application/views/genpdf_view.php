<?php

$invoiceDate = date("d/M/Y");
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	
	<td width="35%">         
	Invoice No. : '.$invoice.'<br />
	Invoice Date : '.$invoiceDate.'<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">Item Name</th>
	<th align="left">Quantity</th>
	<th align="left">Price</th>
	<th align="left">Tax</th> 
	<th align="left">Total(excl.Tax)</th> 
	<th align="left">Total(incl.Tax)</th> 
	</tr>';
$count = 0;   
$tax=0;
foreach($invoiceItems as $invoiceItem){
	$count++;
    $tax+=$invoiceItem["tax"];
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["product_name"].'</td>
	<td align="left">'.$invoiceItem["quantity"].'</td>
	<td align="left">'.$invoiceItem["price"].'</td>
	<td align="left">'.$invoiceItem["tax"].'%</td>   
	<td align="left">'.$invoiceItem["total_notax"].'</td>   
	<td align="left">'.$invoiceItem["total_tax"].'</td>   
	</tr>';
}
$final_values=$invoiceValues[0];
$output .= '
	<tr>
	<td align="right" colspan="6"><b>Subtotal(excl.Tax)</b></td>
	<td align="left">'.$final_values['subTotal_notax'].'</td>
	</tr>
    <tr>
	<td align="right" colspan="6">Tax Rate</td>
	<td align="left">'.$tax.'%</td>
	</tr>
	<tr>
	<td align="right" colspan="6"><b>Subtotal(incl.Tax)</b></td>
	<td align="left">'.$final_values['subTotal_tax'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="6">Discount: </td>
	<td align="left">'.$final_values['discountamt'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="6"><b>Total Amount($)</b></td>
	<td align="left"><b>'.$final_values['total_amt'].'</b></td>
	</tr>
	
	';
$output .= '
	</table>
	</td>
	</tr>
	</table>';

    echo $output;
?>