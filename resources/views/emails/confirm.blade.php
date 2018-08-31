Hello {{$user->name}}
You changed your mail, so we need verify this new adress. Please using this link below:
{{route('verify', ['token' => $user->verification_token])}}
