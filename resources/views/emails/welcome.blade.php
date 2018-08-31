Hello {{$user->name}}
Thank you for create an acconunt. Please verify your mail using this link:
{{route('verify', ['token' => $user->verification_token])}}




