@extends('layout.master')

<?php
$pageTitle = Lang::get($langBase.'pageTitle'.$langAction);
$breadcrumbs = array(
  Lang::get($langBase.'crumb'.$langAction),
);
$pageHeading = Lang::get($langBase.'heading'.$langAction);
?>

@section('content')
<p>This is the ${name?replace(".blade", "")} view.</p>
@stop