import PrimaryButton from '@/Components/PrimaryButton';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import fondo from '../../assets/video/video.mp4';
import '@/../css/loginOrria/verify.css'


export default function VerifyEmail({ status }) {
    const { post, processing } = useForm({});

    const submit = (e) => {
        e.preventDefault();

        post(route('verification.send'));
    };

    return (
      
        <GuestLayout>
            <video className="video-background" autoPlay muted loop>
          <source src={fondo} type="video/mp4" />
        </video>

            <div className="mb-4 text-sm text-white">
                
Mila esker izena emateagatik! Hasi aurretik, egiazta dezakezu?
zure helbide elektronikoa, posta elektronikoz bidali berri dugun estekan klik eginez.
Zu? Ez baduzu posta elektronikoa jaso, pozik bidaliko dizugu.
beste bat.

            </div>

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    A new verification link has been sent to the email address
                    you provided during registration.
                </div>
            )}

            <form onSubmit={submit}>
                <div className="mt-4 flex items-center justify-between">
                    <PrimaryButton
                        className="bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        disabled={processing}
                    >
                        Berbidali egiazpaten email-a
                    </PrimaryButton>

                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="rounded-md text-sm text-white underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Saioa itxi
                    </Link>
                </div>
            </form>
        </GuestLayout>
    );
}
