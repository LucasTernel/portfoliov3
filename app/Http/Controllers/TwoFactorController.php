<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA as Google2FALib;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
// Import essentiel pour valider la session
use PragmaRX\Google2FALaravel\Support\Authenticator;

class TwoFactorController extends Controller
{
    // 1. AFFICHER LE FORMULAIRE D'ACTIVATION (QR CODE)
    public function show2faForm()
    {
        $user = Auth::user();
        $google2fa = new Google2FALib();

        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $g2faUrl = $google2fa->getQRCodeUrl(
            'Lucas Ternel Portfolio',
            $user->email,
            $user->google2fa_secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $QR_Image = $writer->writeString($g2faUrl);

        return view('admin.2fa.enable', [
            'QR_Image' => $QR_Image, 
            'secret' => $user->google2fa_secret
        ]);
    }

    // 2. ACTIVER LA 2FA (Premier scan)
    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FALib();

        $request->validate([
            'one_time_password' => 'required',
        ]);

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if ($valid) {
            // On connecte l'utilisateur en 2FA
            app(Authenticator::class)->login();
            return redirect()->route('admin.dashboard')->with('success', '2FA Activée !');
        }

        return back()->with('error', 'Code incorrect.');
    }
    
    // 3. PAGE DE VÉRIFICATION (Connexion suivante)
    public function verifyTwoFactor(Request $request)
    {
        // CORRECTION : On pointe vers le bon fichier que tu as créé
        return view('admin.2fa.index');
    }
    
    // 4. TRAITEMENT DE LA VÉRIFICATION (C'est ici qu'il manquait la logique)
    public function verifyTwoFactorStore(Request $request)
    {
        // A. On valide qu'il y a une entrée
        $request->validate([
            'one_time_password' => 'required',
        ]);

        $user = Auth::user();
        $google2fa = new Google2FALib();

        // B. On vérifie si le code correspond au secret de l'utilisateur
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if ($valid) {
            // C. C'EST LA LIGNE MAGIQUE QUI MANQUAIT :
            // On dit au système "C'est bon, cet utilisateur a passé la 2FA pour cette session"
            app(Authenticator::class)->login();

            // D. Maintenant on peut aller au dashboard
            return redirect()->route('admin.dashboard');
        }

        // E. Si le code est faux
        return back()->withErrors(['one_time_password' => 'Code incorrect.']);
    }
}