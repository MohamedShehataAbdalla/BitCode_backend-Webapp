<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 12px;
				line-height: 12px;
				font-family: 'almarai', sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 30px;
				line-height: 30px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
				font-size:11px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
				font-size:14px;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'almarai', sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box rtl">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="7">
						<table>
							<tr>
                                <td>
									الفاتورة #: {{ $invoice_id }}<br />
									تاريخ الفاتورة: {{ $invoice_date->format('Y-m-d') }}<br />
									تاريخ الطباعة: {{ Carbon\Carbon::now()->format('Y-m-d') }}
								</td>

								<td class="title">
									<img src="https://www.sparksuite.com/images/logo.png" style="width:100px; max-width:100px;">
								</td>

							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="7">
						<table>
							<tr>
                                <td>
									{{ $customer_name }}.<br />
									{{ $customer_mobile }}<br />
									{{ $customer_email }}
								</td>

								<td>
									Nasr Market.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td style="text-align:center; width:1px">#</td>
                    <td style="text-align:center">القسم</td>
                    <td style="text-align:center">المنتج</td>
                    <td style="text-align:center">الوحدة</td>
                    <td style="text-align:center">الكمية</td>
                    <td style="text-align:center">السعر</td>
                    <td style="text-align:center">إجمالي المنتج</td>
				</tr>

               @foreach($items as $item)
                    <tr class="details item {{ $loop->last ? 'last' : '' }}">
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-align:right">{{ $item['section'] }}</td>
                        <td style="text-align:right">{{ $item['product'] }}</td>
                        <td style="text-align:right">{{ $item['unit'] }}</td>
                        <td style="text-align:center">{{ $item['quantity'] }}</td>
                        <td style="text-align:center">{{ $item['price'] }}</td>
                        <td style="text-align:center">{{ $item['item_total'] }}</td>
                    </tr>
                @endforeach

				<tr class="item">
					<td colspan="5"></td>
					<td>الإجمالي</td>
					<td style="text-align:center">{{ $sub_total }}</td>
				</tr>
				<tr class="item">
					<td colspan="5"></td>
					<td>نسبة الخصم</td>
					<td style="text-align:center">{{ $discount_percentage }}%</td>
				</tr>
				<tr class="item">
					<td colspan="5"></td>
					<td>تكلفة التوصيل</td>
					<td style="text-align:center">{{ $delivery_cost }}</td>
				</tr>
				<tr class="total">
					<td colspan="5"></td>
					<td>الصافي</td>
					<td style="text-align:center">{{ $total_due }} ج.م </td>
				</tr>
				<tr class="item last">
					<td colspan="5"></td>
					<td>المدفوع</td>
					<td style="text-align:center">{{ $paid_amount }} ج.م </td>
				</tr>
				<tr class="item" style="display:{{ $remaining_amount == 0 ? 'none' : null }}">
					<td colspan="5"></td>
					<td>المتبقي</td>
					<td style="text-align:center">{{ $remaining_amount }} ج.م </td>
				</tr>
			</table>
		</div>
	</body>
</html>
