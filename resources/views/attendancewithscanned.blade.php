<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Header</title>
    <style>
        body {
            font-family: 'Century Gothic', sans-serif;

        }

        .headerTitle {
            width: 88%;
            border-collapse: collapse;
            /* Remove space between cells */
            border: 0;
             margin: 0; /* Ensures no margins are applied to the table */
            padding: 0;
            margin-top:-120px;
            /* Remove border */
        }

        .logo {
            width: 100px;
             padding: 0;
            /* Adjust logo size */
        }

        .title {
            font-size: 14px;
            padding: 0;
            /* Title size */
            font-weight: bold;
            text-align: left;
            color: navy;
        }

        .subtitle {
            color: navy;
            font-size: 14px;
            padding: 0;

            text-align: left;
        }

        .title, .subtitle {
            margin: 0; /* Remove margin from title/subtitle */
            padding: 0; /* Remove padding from title/subtitle */
            line-height: 1; /* Adjust line-height for tighter spacing */
        }
        .divider-container {
            width: 100%;
            position: relative;
            margin: 0px 0; 

        }

        .divider {
            border: none;
            border-top: 2px solid black;
            width: 90%; 
        }

        .footer {
            /* font-weight: bold; */
            font-size: 16px;
            position: absolute;
            right: 0;
            top: -10px;
            padding-right: 10px;
        }

        h1 {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
            font-family: 'Century Gothic', sans-serif;
        }

        p {
            margin: 10px 0;
        }

        .instructions {
            margin-top: 10px;
            font-style: italic;
            font-size: 10px;
            font-family: 'Century Gothic', sans-serif;
        }

        .ballpen {
            color: navy;
            text-decoration: underline;
        }

        .pesonalInfo {
            width: 68%;


        }

        .pesonalInfo th,
        .pesonalInfo td {
            /* border: 0; */
            /* Remove borders from cells */

            text-align: center;
        }

        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(270deg);
            background-color: #003366;
            /* Dark blue background */
            color: white;
            white-space: nowrap;
            font-size: 10px;
        }


        .form-container {
            border: 1px solid #000;
            padding: 20px;
            width: 800px;
            margin: auto;
        }

        .section {
            /* display: flex;
            justify-content: space-between; */
        }

        .column {
            /* width: 48%; */
        }

        .section h2 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            /* margin: 10px 0; */
        }

        .checkbox {
            /* margin-bottom: 10px; */
        }

        .signature {
            margin-top: 20px;
            text-align: right;
        }

        .lastTable .otherInfo .container {
            /* background-color: #fff;  */
        }

        .lastTable .otherInfo table {
            width: 100%;
            border-collapse: collapse;
        }

        .lastTable .otherInfo th,
        td {
            /* padding: 10px; */
            /* No border */
            font-size: 10px;
            font-weight: bold;
        }

        .lastTable .otherInfo th {
            text-align: left;
        }

        .lastTable .otherInfo .specify {
            border: none;
            border-bottom: 1px solid #ccc;
            width: 60px;
            /* margin-right: 30px; */
            outline: none;
            margin-left: 10px;
        }

        .lastTable .otherInfo .specify:focus {
            border-bottom: 1px solid #007BFF;
            /* Change color on focus */
        }

        .lastTable table {
            width: 100%;
            border-collapse: collapse;
        }

        .lastTable td {
            /* border: 1px solid #ccc;       */
        }

        .lastTable .last-column {
            /* background-color: #002147; Dark blue background for the last column */
            /* color: white; */
            /* width: 200px; Fixed width for the last column */
        }

        .note {
            text-align: left;
            font-weight: normal;
            font-style: italic;
            margin-bottom: 10px;
            font-family: 'Century Gothic', sans-serif;
            margin-left: 10px;

        }

        .center-table {
            width: 600px;
            /* Fixed width */
            margin: auto;
            /* Centered */
            /* border-collapse: collapse; */

        }

        .center-table th,
        .center-table td {
            /* padding: 10px; */
            /* Padding for cells */
            text-align: left;
            /* Align text to the left */
        }

        .center-table .input-field {
            border: none;
            border-bottom: 1px solid #000;
            /* Underline effect */
            outline: none;
            width: 100%;
            /* Full width for input fields */
        }

        .schedule-table {
            width: 600px;
            /* Fixed width */
        }

        .schedule-table th,
        .schedule-table td {
            /* padding: 10px; */
            /* Padding for cells */
            text-align: left;
            /* Align text to the left */
        }

        .schedule-table .input-field {
            border: none;
            border-bottom: 1px solid #000;
            /* Underline effect */
            outline: none;
            width: 100%;
            /* Full width for input fields */
        }

        .schedule-table .bold {
            font-weight: bold;
            /* Bold text */
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .checkbox-group label {
            margin-right: 15px;
            /* Space between checkboxes */
        }

        .id-picture {
            text-align: center;

        }
        #footer {
        position: fixed;
        bottom: -34px;
        }
        .h-label {
    
            width: 100%;
            padding-right:10px;
            padding-left:10px;

        }
        .h-label td {
            padding: 5px;
           /* Border for clarity */
        }
        .h-label .bold {
            font-weight: bold; /* Bold text for venue */
        }
        .h-label .border-b {
            /* border-bottom: 2px solid black; Thicker bottom border for separation */
        }
        .header{
            padding-left:16px;
            padding-right:16px;

        }
     .header table {
            
            width: 100%; /* Full width of the container */
            border-collapse: collapse; 
            margin-bottom: 20px; /* Spacing below the table */
            
        }
       .header th {
            text-align: center; /* Align header text to the left */
            background-color: #f2f2f2; /* Light background for header */
            padding: 10px; /* Padding for better spacing */
            border-bottom: 2px solid black; 
            font-size:14px;;
        }
       .header td { 
        padding: 4px;
            border: 1px solid black; /* Border for table cells */
        }
        .bold {
            font-weight: bold; /* Bold text styling */
        }
        .right-align {
            text-align: right; /* Right alignment for specified cells */
        }
          .logo-container {
            display: flex; /* Set to flexbox */
            justify-content: space-between; /* Space items out */
            align-items: center; /* Align items vertically */
            padding: 10px; /* Optional padding */
        }
      
    </style>
</head>

<body style="margin:-30px -20px;  margin-bottom: -30px;">
<div style="position: relative; width: 100%; height: 100px; overflow: hidden;">
    <img src="images/psuHeader.png" alt="University Logo" style="position: absolute; left: 0; height: 100px;">
    <img src="images/bagong_pilipinas.png" alt="University Logo" style="position: absolute; right: 0; margin-top:20px; height: 60px;">
</div>

    <div class="divider-container" style="margin-top:-10px; margin-bottom:10px;">
        <hr class="divider">
         
    </div>

<div class="header">

<table class="">
    <thead>
        <tr>
            <th colspan="4" style="text-align:center">EVENT ATTENDANCE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width:10%;">Event:</td>
            <td>{{ strtoupper( $event->event->name) }}</td>
            <td class="right-align">Venue:</td>
            <td class="bold">{{strtoupper( $event->event->venue)  }}</td>
        </tr>
        <tr>
            <td>Date:</td>
            <td>{{strtoupper(\Carbon\Carbon::parse($event->when)->format('F j, Y'))  }}</td>
       <td></td>
       <td></td>

        </tr>
    </tbody>
</table>

</div>
  


  
    

  

    <table style="border-collapse: collapse; width: 100%; padding:16px;">
            <thead>
                <tr>
                    <th style="padding: 4px; font-size:12px; border: 1px solid #000000; background-color: #ffffff; text-align: center;">#</th> 
                    <th style="padding: 4px; font-size:12px; border: 1px solid #000000; background-color: #ffffff; text-align: center;">Name</th>
                    <th style="padding: 4px; font-size:12px; border: 1px solid #000000; background-color: #ffffff; text-align: center;">Time Arrive</th>
                    <th style="padding: 4px; font-size:12px; border: 1px solid #000000; background-color: #ffffff; text-align: center;">Remarks</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($applicant as $applicant)
            <tr>
                <td style="padding: 6px; border: 1px solid #000000; font-size: 11px; width: 14px; text-align: center;">{{ $applicant['index'] }}</td>
                <td style="padding: 6px; border: 1px solid #000000; font-size: 11px;">{{ $applicant['name'] }}</td>
                <td style="padding: 6px; border: 1px solid #000000; font-size: 11px;">{{ $applicant['date'] }}</td>
                <td style="padding: 6px; border: 1px solid #000000; font-size: 11px;"></td>
            </tr>
        @endforeach
            </tbody>
        </table>
     
    

</body>

</html>