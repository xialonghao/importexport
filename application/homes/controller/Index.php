<?php
    namespace app\homes\controller;
    use think\Controller;
    use PHPMailer\PHPMailer\PHPMailer;
    class Index extends Controller{
        public function index(){
            //Loader::import('PHPMailer.PHPMailer.PHPMailer');
            $mail=new PHPMailer();
            $toemail = '2278259541@qq.com';//定义收件人的邮箱
            $mail->isSMTP();// 使用SMTP服务
            $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
            $mail->Host = "smtp.126.com";// 发送方的SMTP服务器地址
            $mail->SMTPAuth = true;// 是否使用身份验证
            $mail->Username = "xialongh@126.com";// 发送方的邮箱用户名，就是自己的邮箱名
            $mail->Password = "xia980531";// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
            //$mail->SMTPSecure = "ssl";// 使用ssl协议方式,
            $mail->Port = 25;// QQ邮箱的ssl协议方式端口号是465/587
            $mail->setFrom("xialongh@126.com","夏龙浩");// 设置发件人信息，如邮件格式说明中的发件人,
            $mail->addAddress($toemail,'test111');// 设置收件人信息，如邮件格式说明中的收件人
            $mail->addReplyTo("baoshan01@126.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
            //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
            //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
            //$mail->addAttachment("bug0.jpg");// 添加附件
            $mail->Subject = '霞龙啊后';// 邮件标题
            $mail->Body = '大师弗兰克教授的解决了付款结算单';// 邮件正文
            //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

            if(!$mail->send()){// 发送邮件
                echo "Message could not be sent.";
                echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
            }else{
                echo '发送成功';
            }
        }
    }
?>