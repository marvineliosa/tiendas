<?php
  namespace App\Http\Controllers;

    use App\User;
    use App\Http\Controllers\Controller;
    use PhpOffice\PhpSpreadsheet\Reader\Xls;
    use Illuminate\Http\Request; //indispensable para usar Request de los JSON
    use Illuminate\Support\Facades\Storage;
    use App\Mail\EnvioMail;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\DB;//consulta a la base de datos

    class MailsController extends Controller
    {  
        /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return Response
         */

        public static function EnviarFacturaMail($datos){
            //dd($datos);
            $destinatario = $datos['mail'];//correo con copia
            $pdf = str_replace('\\', '/',storage_path('app')).'/public/temporal/'.'prueba.pdf';
            $pdf = str_replace('\\', '/',storage_path('app')).'/'.$datos['ruta'];
            //dd($pdf);
            //$pdf = $datos['ruta'];
            $ruta = $datos['ruta'];
            //dd($pdf);
            $asunto = "Recibo de compra Tienda BUAP";
            $containfile = ((Storage::exists($ruta) && Storage::exists($ruta))?true:false);
            //dd($containfile);
            $data = array('fecha' => $datos['fecha_venta']);
            $fl = false;
            if($containfile){//si existen los archivos
                $fl = Mail::send('mails.remision', $data, function ($message) use ($asunto,$destinatario,  $containfile,$pdf){
                    $message->from('tiendabuap@gmail.com', 'TIENDA BUAP');
                    $message->to($destinatario)->subject($asunto);
                    if($containfile){
                        $message->attach($pdf);
                        //$message->attach($xml);
                    }
                });
            }
        }

        //Ejemplo de enviar un EMAIL FUNCIONANDO
        public function pruebamail(){
            $data = array('pass'=>"123456789");
            // Path or name to the blade template to be rendered
            $template_path = 'mails.enviar_contrasena';
            $nombre_usuario = 'Coordinación General Administrativa';
            $destinatario = 'marvineliosa@hotmail.com';
            Mail::send($template_path,$data, function($message) use ($nombre_usuario,$destinatario) {
                // Set the receiver and subject of the mail.
                $message->to($destinatario, $nombre_usuario)->subject('[Sistema de Solicitudes]Envío de contraseña');
                // Set the sender
                $message->from($destinatario,'Solicitudes CGA');
            });

            return "Mail enviado correctamente.";
        }

    }