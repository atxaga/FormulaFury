import { useForm, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import { useState } from 'react';
import { Inertia } from '@inertiajs/inertia'; 
import '../../../css/gehituPuntuak/gehituPuntuak.css';


function PuntuakGehitu() {
  const { gidariak, taldeak, lasterketak } = usePage().props;
  const [aukeratutakoTaldeaI, setAukeratutakoTaldea] = useState(0);
  const [aukeratutakoGidariaI, setAukeratutakoGidaria ] = useState(0);
  const [gp, setAukeratutakoGP] = useState(0);
  const [kategoria, setkategoria] = useState("");
  const { data, setData, post, errors, reset, } = useForm({
    pos_qualy: '',
    pos_race: '',
    h2h_qualy: '',
    h2h_race: '',
    pole: '',
    buelta_azkarra: '',
    sprint: ''
  });
  const [formAukera, setFormAukera] = useState("");


  const submit = (e) => {
    e.preventDefault();
  
    const aukeratutakoa = formAukera === "gidariak" ? aukeratutakoGidariaI : aukeratutakoTaldeaI;
    const datuak = {
          data: data,
          aukeratutakoa: aukeratutakoa,
          gp: gp,
          tipo: formAukera,
          kategoria: kategoria
        };
        Inertia.post('/gehituPuntuak', datuak);
  };
  

    function setForm (e) {
        let aukeratutakoa = e.target.value;
        setFormAukera(aukeratutakoa);
    }

    function setkategoriaForm(e) {
      let aukeratutakoa = e.target.value;
      setkategoria(aukeratutakoa);
    }

    function aukeratutakoGidaria(e) {
      let aukeratutako = e.target.value;

      setAukeratutakoGidaria(aukeratutako);
    }

    function aukeratutakoTaldea(e) {
      let aukeratutako = e.target.value;

      setAukeratutakoTaldea(aukeratutako);
    }

    function aukeratutakoGP(e) {
      let aukeratutako =  e.target.value;

      setAukeratutakoGP(aukeratutako);
    }
  return (
    <>
      <div className='container text-center'>

        <div className='dena'>
    
          <form className='login-form' onSubmit={submit}>
            <label htmlFor=""><input type="radio" name="aukeratu" id="" onChange={setForm} value="gidariak"/> Gidariak</label>
            <label htmlFor=""><input type="radio" name="aukeratu" id=""  onChange={setForm} value="taldeak"/> Taldeak</label>
            <select name="" id="" onChange={aukeratutakoGP}>
              <option>--Aukeratu GP--</option>
              {lasterketak.map((lasterketa, index) => 
              <option key={index} value={lasterketa.id}>{lasterketa.izena}</option>  
                )
              }
            </select>
            {formAukera === "gidariak" ? (
                <>
                <label htmlFor=""><input type="radio" name="aukeratukategoria" id="" onChange={setkategoriaForm} value="F1"/> F1</label>
                <label htmlFor=""><input type="radio" name="aukeratukategoria" id=""  onChange={setkategoriaForm} value="F2"/> F2</label>
                <select name="" id="" onChange={aukeratutakoGidaria}>
                <option default>--Aukeratu Gidaria--</option>
                    { gidariak.map((gidaria, index) => 
                      <option key={index} value={gidaria.id}>{gidaria.izena}</option>
                    )
                  }
                </select>
                
                <input
                className='login-input'
                type="number"
                id='pos_qualy'
                name="pos_qualy"
                placeholder='Klasifikazio posizioa'
                autoComplete="pos_qualy"
                value={data.pos_qualy}
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

              <input
                className='login-input'
                type="number"
                name="pos_sprint"
                placeholder='Sprint lasterketaren posizioa(F2ko gidaria edo F1 sprint formatuko astea bada)'
                value={data.pos_sprint}
                onChange={(e) => setData('pos_sprint', e.target.value)}
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
                  value={data.h2h_race}
                  onChange={(e) => setData('h2h_race', e.target.value)}
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
                  <select name="" id="" onChange={aukeratutakoTaldea}>
                    <option>--Aukeratu Taldea--</option>
                  {
                    taldeak.map((taldea, index) => 
                      <option key={index} value={taldea.id}>{taldea.izena}</option>
                    )
                  }
                </select>

                <input
              className='login-input'
              type="number"
              id='pos_qualy'
              name="pos_qualy"
              placeholder='Klasifikazio posizioa'
              autoComplete="pos_qualy"
              value={data.pos_qualy}
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
            <br/><br/>
            <button className='gehitu-sartu' type='submit'>Puntuak gehitu</button>
          </form>
        </div>
      </div>
    </>
  );
}

export default PuntuakGehitu;