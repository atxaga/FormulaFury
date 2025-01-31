import { useForm } from '@inertiajs/react';
import '@/../css/loginOrria/register.css';
import fondo from '@/../assets/video/video.mp4';
import InputError from '@/Components/InputError';
import { useState } from 'react';


function Register() {
  const { data, setData, post, processing, errors, reset } = useForm({
    pos_qualy: '',
    pos_race: '',
    h2h_qualy: '',
    h2h_race: '',
    pole: '',
    buelta_azkarra: ''
  });
  const [formAukera, setFormAukera] = useState("");


const submit = (e) => {
    e.preventDefault();

    post(route('gehitu'), {
        onFinish: () => reset('password', 'password_confirmation'),
    });
};

    function setForm (e) {
        let aukeratutakoa = e.target.value;
        setFormAukera(aukeratutakoa);
    }

  return (
    <>
      <div className='container text-center'>

        <div className='dena'>
    
          <form className='login-form' onSubmit={submit}>
            <label htmlFor=""><input type="radio" name="aukeratu" id="" onChange={setForm} value="gidariak"/> Gidariak</label>
            <label htmlFor=""><input type="radio" name="aukeratu" id=""  onChange={setForm} value="taldeak"/> Taldeak</label>
            {formAukera === "gidariak" ? (
                <>
                <input
                className='login-input'
                type="number"
                id='pos_qualy'
                name="pos_qualy"
                placeholder='Klasifikazio posizioa'
                autoComplete="pos_qualy"
                value={data.pos_qualy}
                isFocused={true}
                onChange={(e) => setData('pos_qualy', e.target.value)}
                required
              />
  
              <InputError message={errors.pos_qualy} className="mt-2" />
  
              <input
                className='login-input'
                type="number"
                name="pos_race"
                placeholder='lasterketaren posizioa'
                value={data.pos_race}
                onChange={(e) => setData('pos_race', e.target.value)}
              />
                      <InputError message={errors.pos_race} className="mt-2" />
  
              <label htmlFor="">Taldekidearen aurretik geratu da klasifikazioan?<select 
                  id='h2h_qualy'
                  name="h2h_qualy"
                  autoComplete="h2h_qualy"
                  value={data.h2h_qualy}
                  onChange={(e) => setData('h2h_qualy', e.target.value)}
                  required
                  >
                      <option value="" default>bai/ez</option>
                      <option value="1">bai</option>
                      <option value="0">ez</option>
              </select></label>
  
              <label htmlFor="">Taldekidearen aurretik geratu da lasterketan?<select 
                  id='h2h_race'
                  name="h2h_race"
                  autoComplete="h2h_race"
                  value={data.h2h_qualy}
                  onChange={(e) => setData('h2h_qualy', e.target.value)}
                  required
                  >
                      <option value="" default>bai/ez</option>
                      <option value="1">bai</option>
                      <option value="0">ez</option>
              </select></label>
  
              <label htmlFor="">Polea egin du?<select 
                  id='pole'
                  name="pole"
                  autoComplete="pole"
                  value={data.pole}
                  onChange={(e) => setData('pole', e.target.value)}
                  required
                  >
                      <option value="" default>bai/ez</option>
                      <option value="1">bai</option>
                      <option value="0">ez</option>
              </select></label>
  
              <label htmlFor="">Bira azkarrena egin du?<select 
                  id='buelta_azkarra'
                  name="buelta_azkarra"
                  autoComplete="buelta_azkarra"
                  value={data.buelta_azkarra}
                  onChange={(e) => setData('buelta_azkarra', e.target.value)}
                  required
                  >
                      <option value="" default>bai/ez</option>
                      <option value="1">bai</option>
                      <option value="0">ez</option>
              </select></label>
              </>
            ) : (
                <>
                <input
              className='login-input'
              type="number"
              id='pos_qualy'
              name="pos_qualy"
              placeholder='Klasifikazio posizioa'
              autoComplete="pos_qualy"
              value={data.pos_qualy}
              isFocused={true}
              onChange={(e) => setData('pos_qualy', e.target.value)}
              required
            />

            <InputError message={errors.pos_qualy} className="mt-2" />

            <input
              className='login-input'
              type="number"
              name="pos_race"
              placeholder='lasterketaren posizioa'
              value={data.pos_race}
              onChange={(e) => setData('pos_race', e.target.value)}
            />
                    <InputError message={errors.pos_race} className="mt-2" />

            <label htmlFor="">Polea egin du?<select 
                id='pole'
                name="pole"
                autoComplete="pole"
                value={data.pole}
                onChange={(e) => setData('pole', e.target.value)}
                required
                >
                    <option value="" default>bai/ez</option>
                    <option value="1">bai</option>
                    <option value="0">ez</option>
            </select></label>

            <label htmlFor="">Bira azkarrena egin du?<select 
                id='buelta_azkarra'
                name="buelta_azkarra"
                autoComplete="buelta_azkarra"
                value={data.buelta_azkarra}
                onChange={(e) => setData('buelta_azkarra', e.target.value)}
                required
                >
                    <option value="" default>bai/ez</option>
                    <option value="1">bai</option>
                    <option value="0">ez</option>
            </select></label>
            </>
            )}
          

            <button className='sartu' type='submit' disabled={processing}>Puntuak gehitu</button>
          </form>
        </div>
      </div>
    </>
  );
}

export default Register;