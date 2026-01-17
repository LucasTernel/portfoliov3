<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réponse de Lucas Ternel</title>
</head>
<body style="background-color: #0a0a0a; margin: 0; padding: 0; font-family: Arial, sans-serif;">
    
    <div style="max-width: 600px; margin: 0 auto; background-color: #111; border: 1px solid #333; margin-top: 40px; border-radius: 12px; overflow: hidden;">
        
        <div style="background-color: #000; padding: 20px; text-align: center; border-bottom: 2px solid #D6F32F;">
            <h1 style="color: #fff; margin: 0; font-size: 24px; text-transform: uppercase;">
                LUCAS<span style="color: #D6F32F;">TERNEL</span>
            </h1>
        </div>

        <div style="padding: 30px; color: #ddd; line-height: 1.6;">
            
            <p style="font-size: 18px; margin-bottom: 20px;">Bonjour {{ $contact->name }},</p>
            
            <p>Merci de m'avoir contacté. Voici ma réponse à ton message :</p>
            
            <div style="background-color: #1a1a1a; padding: 25px; border-radius: 8px; border-left: 4px solid #D6F32F; margin: 25px 0; color: #fff;">
                {!! nl2br(e($replyMessage)) !!}
            </div>

            <hr style="border: 0; border-top: 1px solid #333; margin: 30px 0;">

            <div style="font-size: 0.9rem; color: #666;">
                <p style="margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;">
                    Ton message original du {{ $contact->created_at->format('d/m/Y') }} :
                </p>
                <div style="background-color: #0f0f0f; padding: 15px; border-radius: 6px; border: 1px solid #222; font-style: italic;">
                    "{{ $contact->message }}"
                </div>
            </div>

        </div>

        <div style="background-color: #000; padding: 20px; text-align: center; color: #666; font-size: 12px;">
            <p style="margin: 0;">Lucas Ternel — Développeur Web</p>
            <p style="margin: 5px 0 0 0;"><a href="https://lucasternel.com" style="color: #D6F32F; text-decoration: none;">www.lucasternel.com</a></p>
        </div>
    </div>

</body>
</html>