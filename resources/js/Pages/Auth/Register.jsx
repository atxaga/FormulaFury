import { useForm } from '@inertiajs/react';
import '@/../css/loginOrria/register.css';
import fondo from '@/../assets/video/video.mp4';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link } from '@inertiajs/react';

function Register() {
  const { data, setData, post, processing, errors, reset } = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = (e) => {
    e.preventDefault();

    post(route('register'), {
        onFinish: () => reset('password', 'password_confirmation'),
    });
};

  return (
    <>
      <div className='container text-center'>
        <video className="video-background" autoPlay muted loop>
          <source src={fondo} type="video/mp4" />
        </video>

       

        <div className='dena'>
        <div className='sesioa'>
        <a href="/">

        <div className='atzeraDiv'>
        <p>&lt; </p> <p  className='atzera'>Atzera</p>
        </div>
        </a>

        <p>Ongi etorri!</p>
        </div>
          <form className='login-form' onSubmit={submit}>
          <input
              className='login-input'
              type="text"
              id='name'
              name="name"
              placeholder='Izena'
              autoComplete="name"
              value={data.name}
              isFocused={true}
              onChange={(e) => setData('name', e.target.value)}
              required
            />

            <InputError message={errors.name} className="mt-2" />

            <input
              className='login-input'
              type="email"
              name="email"
              placeholder='E-mail'
              value={data.email}
              onChange={(e) => setData('email', e.target.value)}
            />
                    <InputError message={errors.email} className="mt-2" />

            <input
              className='login-input'
              type="password"
              name="password"
              placeholder='Pasahitza'
              value={data.password}
              onChange={(e) => setData('password', e.target.value)}
            />
                    <InputError message={errors.password} className="mt-2" />

            <input
              className='login-input'
              type="password"
              id='password_confirmation'
              name="password_confirmation"
              placeholder='Pasahitza errepikatu'
              autoComplete="new-password"
              value={data.password_confirmation}
              onChange={(e) =>
                  setData('password_confirmation', e.target.value)
              }
              required
            />
                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
            <div className='onartu'>
  <input type="checkbox" name="onartu" id="check" className="black-checkbox circular-checkbox" />
  <p className='onarpena'>
    Irakurri dut eta onartzen dut Formula Fury enpresak zure datuekin 
    <a href=""> nahi duena </a> egiten ahal duela
  </p>
</div>

            <button className='sartu' type='submit' disabled={processing}>Kontua sortu</button>
          </form>
        </div>
      </div>
    </>
  );
}

export default Register;