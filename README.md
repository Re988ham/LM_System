+ Auth with google
  notice:To download the socialite package, simply run this command:
  -> “composer require laravel/socialite”
  in env  'google' => [
  'client_id' => '433552084977-358da5pgdf9i8in1bjuce81msoj6e2jv.apps.googleusercontent.com',
  'client_secret' => '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',
  'redirect' => 'http://127.0.0.1:8000/login/google/callback',
  ]
  in config/service:
  GOOGLE_CLIENT_ID=433552084977-358da5pgdf9i8in1bjuce81msoj6e2jv.apps.googleusercontent.com
  GOOGLE_CLIENT_SECRET=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
  GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/login/google/callback

+ First version of database and models with relations
  for the main app's idea

the link of ERD here : (Editing is allowable)

https://lucid.app/lucidchart/6640c799-1fe0-4bb5-8915-107c5220b536/edit?viewport_loc=-777%2C-1147%2C5450%2C3085%2C0_0&invitationId=inv_f81c5418-3242-4197-9893-ccad83b6fc3c
