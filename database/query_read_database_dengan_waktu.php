<?php
read database berdasarkan waktu

//query database berdasarkan bulan juni
dataBase::with('produk')->whereMonth(06)->get();
==========================
 $bulan = Carbon::parse($data->created_at)->format('m');
dataBase::with('produk')->whereMonth($bulan)->get();

fungsi lain =
whereYear()
whereDay()

/>
