@extends('layouts.emails')
@section('content')

    <h3>عزيزي العميل {{ $invoice->customer->name ?? null }}</h3>

    <h4>تحية طيبة...</h4>

    <p>أعرض الفاتورة</p>

@endsection