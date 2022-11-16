<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อาหารไทยชื่อดัง</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .food{
            width:370px;
            height:300px;
        }
    </style>
</head>
<body>
        <div class="container">
            <div class="row">
                <div id="result">
                   
                </div>
                
            </div>
            <center><div class="loading"><img src="https://media1.giphy.com/media/y1ZBcOGOOtlpC/200.gif" alt=""></div></center>
        </div>

</body>

<script type="text/javascript">
        var page=1; 
        load_more(page);
        $(window).scroll(function(){
            if($(window).scrollTop()+$(window).height()>=$(document).height()){
                page++;
                load_more(page);
            }
        });
        function load_more(page){
            $.ajax({
                //ส่ง Query String ไปที่เป็น Page
                url:'?page='+page, //4*1 4*2 4*3
                type:'get',
                dataType:'html',
                beforeSend:function(){
                    $('.loading').show();
                }
                }).done(function(data){
                    if(data.length==0){
                        $('.loading').html('<b>ไม่พบข้อมูลเพิ่มเติม</b>');
                        return;
                    }
                    $('.loading').hide();
                    $('#result').append(data);
                });
            }
</script>

</html>