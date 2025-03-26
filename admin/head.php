<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Performing Arts Theater</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
      .mt20{
        margin-top:20px;
      }
      .bold{
        font-weight:bold;
      }

      /*chart style*/
      #legend ul {
        list-style: none;
      }

      #legend ul li {
        display: inline;
        padding-left: 30px;
        position: relative;
        margin-bottom: 4px;
       /* border-radius: 5px;*/
        padding: 2px 8px 2px 28px;
        font-size: 14px;
        cursor: default;
        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;
      }

      #legend li span {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
       /* border-radius: 5px;*/
      }
      body > div > header > nav,
      body > div > header > a{
        <?php if($_SESSION['type'] == 2): ?>


        <?php else: ?>
          background-color: #6e7782 !important;
        <?php endif; ?>
      }
      .radios{
        transform: scale(1.4);
      }
      /* Blink for Webkit and others
(Chrome, Safari, Firefox, IE, ...)
*/

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
  text-decoration: blink;
  -webkit-animation-name: blinker;
  -webkit-animation-duration: 0.6s;
  -webkit-animation-iteration-count:infinite;
  -webkit-animation-timing-function:ease-in-out;
  -webkit-animation-direction: alternate;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: red;
  box-shadow: 0px 0px 10px red;
  position: absolute;
  top: 10px;
  left: 30px;
}
.mobile_name{
  margin-top: 10px;
  margin-left: 5px;
  font-weight: bold;
  position: absolute;
  top: -5px;
  left: 60px;
  width: 200px;
  background-color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  display: none;
  z-index: 1;
}
.left_messages{
  width: 30rem !important;
}

@media screen and (max-width: 768px){
  .left_messages{
  width: 10rem !important;
}
.holdleft:hover .mobile_name{
  display: block;
}
.desktop_name{
  display: none;
}
}

.chat{
  background-color: #edf0f5;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  padding: 20px;
}
.box_data_wrapper,.box_data_wrapper2{
 height: 400px;
  overflow-y: auto;
}
.box_data,.box_data2{
 
  padding: 10px;
}
.conversation__view__bubbles {
    margin-bottom: 50px;
}
.conversation__view__bubbles::before{
  content: '';
    display: table;
    clear: both;
}
.chat__right__bubble {
    float: right;
    position: relative;
    border-bottom-right-radius: 0;
    color: hsl(342, 100%, 95%);font-size: 0.9em;
    padding: 8px;
    border-radius: 6px;
    word-break: break-all;
}
.chat__right__bubble:after{
  content: '';
  display: block;
}


.conversation__view__bubbles2 {
    margin-bottom: 50px;
}
.conversation__view__bubbles2::before{
  content: '';
    display: table;
    clear: both;
}
.chat__right__bubble2 {
    float: left;
    position: relative;
    border-bottom-right-radius: 0;
    padding: 8px;
    border-radius: 6px;
    word-break: break-all;
}
.chat__right__bubble2:after{
  content: '';
  display: block;
}
.messages_count,.customers_info_count{
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #fff;
  text-align: center;
  width: 20px;
  height: 20px;
  font-weight: bold;
  background-color: red;
  border-radius: 50%;
}

.downpayment,.date_harvest,.downpayment2,.date_harvest2,.MonthlyChart,.WeeklyChart,.DailyChart{
  display: none;
}
.downpayment_show,.date_harvest_show,.downpayment2_show,.date_harvest2_show,.DailyChart_show,.MonthlyChart_show,.WeeklyChart_show{
  display: block;
}



.notif{
  position: absolute;
  top: 18px;
  left: 23px;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background-color: red;
}

.cardnotif{
  position: absolute;
  right: 0px;
  top: 50px;
  z-index: 1000;
  width: 300px;
  height: 350px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
  background-color: #fff;
  display: none;
}
.cardnotif_show{
  display: block;
}


/*div#cke_1_contents{
  height: 500px !important;
}*/
    </style>