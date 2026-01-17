<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réponse de Lucas Ternel</title>
    <style>
        body, table, td { font-family: Arial, Helvetica, sans-serif !important; }
        a { text-decoration: none !important; }
        img { display: block; border: 0; }
    </style>
</head>
<body style="background-color: #0a0a0a; margin: 0; padding: 0;">
    
    <div style="max-width: 600px; margin: 0 auto; background-color: #111; border: 1px solid #333; margin-top: 20px; margin-bottom: 20px; border-radius: 12px; overflow: hidden;">
        
        <div style="background-color: #000; padding: 20px; text-align: center; border-bottom: 2px solid #D6F32F;">
            <h1 style="color: #fff; margin: 0; font-size: 24px; text-transform: uppercase;">
                LUCAS <span style="color: #D6F32F;">TERNEL</span>
            </h1>
        </div>

        <div style="padding: 30px; color: #ddd; line-height: 1.6;">
            
            <p style="font-size: 18px; margin-bottom: 20px; color: #fff;">Bonjour {{ $contact->name }},</p>
            
            <p>Merci de m'avoir contacté. Voici ma réponse à ton message :</p>
            
            <div style="background-color: #1a1a1a; padding: 25px; border-radius: 8px; border-left: 4px solid #D6F32F; margin: 25px 0; color: #fff;">
                @if(empty($replyMessage))
                    <em style="color: red;">(Erreur : Le message est vide. Vérifiez le contrôleur.)</em>
                @else
                    {!! nl2br(e($replyMessage)) !!}
                @endif
            </div>

            <br>
            <p style="margin-bottom: 15px; color: #888;">Cordialement,</p>

            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #050505; border: 1px solid #333333; border-radius: 12px; overflow: hidden;">
                <tr>
                    <td style="padding: 20px; vertical-align: middle; color: #ffffff;">
                        <div style="font-family: Arial, sans-serif; color: #D6F32F; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 11px; margin-bottom: 5px;">
                            DÉVELOPPEUR WEB
                        </div>
                        <h1 style="font-family: Arial Black, Arial, sans-serif; font-size: 24px; font-weight: 900; line-height: 1.1; margin: 0 0 15px 0; color: #ffffff; text-transform: uppercase;">
                            LUCAS<br>TERNEL
                        </h1>
                        <table border="0" cellpadding="0" cellspacing="0" style="color: #cccccc;">
                            <tr>
                                <td style="padding-bottom: 5px; padding-right: 8px; width: 20px;"><span style="color: #D6F32F; font-size: 14px;">✉️</span></td>
                                <td style="padding-bottom: 5px;"><a href="mailto:contact@lucasternel.com" style="color: #eeeeee; font-size: 12px;">contact@lucasternel.com</a></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 5px; padding-right: 8px;"><span style="color: #D6F32F; font-size: 14px;">📞</span></td>
                                <td style="padding-bottom: 5px;"><a href="tel:0611728994" style="color: #eeeeee; font-size: 12px;">06 11 72 89 94</a></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 5px; padding-right: 8px;"><span style="color: #D6F32F; font-size: 14px;">🌐</span></td>
                                <td style="padding-bottom: 5px;"><a href="https://lucasternel.com" target="_blank" style="color: #eeeeee; font-size: 12px;">www.lucasternel.com</a></td>
                            </tr>
                            <tr>
                                <td style="padding-right: 8px;"><span style="color: #D6F32F; font-size: 14px;">🔗</span></td>
                                <td><a href="https://www.linkedin.com/in/votre-profil" target="_blank" style="color: #D6F32F; font-size: 12px; font-weight: 700; border-bottom: 1px dotted #D6F32F; text-decoration: none;">Mon Linkedin</a></td>
                            </tr>
                        </table>
                    </td>
                    <td width="130" style="vertical-align: middle; text-align: center; padding: 15px; background-color: #080808; border-left: 1px solid #222;">
                        <img src="{{ url(Vite::asset('resources/images/logo.png')) }}" alt="Logo" width="100" style="width: 100px; height: auto; margin: 0 auto; display: block;">
                    </td>
                </tr>
            </table>

            <hr style="border: 0; border-top: 1px solid #333; margin: 30px 0;">

            <div style="font-size: 0.85rem; color: #666;">
                <p style="margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; font-size: 0.7rem;">
                    Message original du {{ $contact->created_at->format('d/m/Y') }} :
                </p>
                <div style="background-color: #0f0f0f; padding: 15px; border-radius: 6px; border: 1px solid #222; font-style: italic;">
                    "{{ $contact->message }}"
                </div>
            </div>

        </div>
        
        <div style="background-color: #000; padding: 15px; text-align: center; color: #444; font-size: 11px;">
            &copy; {{ date('Y') }} Lucas Ternel Portfolio.
        </div>
    </div>
</body>
</html>