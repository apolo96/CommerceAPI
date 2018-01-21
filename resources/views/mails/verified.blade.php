Hola {{$user->name}}
Gracias por crear una cuenta. Por favor verifica usando el soguiente enlace:
{{route('verify',$user->verification_token)}}