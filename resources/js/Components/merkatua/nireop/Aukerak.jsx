import { Inertia } from '@inertiajs/inertia';
import '@/../css/merkatuaOrria/puja.css';
import euro from '@/../images/euro.png';

function Aukerak({ pilot }) {
  const handleOnartu = (e) => {
    e.preventDefault();

    Inertia.post('/onartu', {
      gidaria_id: pilot.id,
      oferta: pilot.oferta,
      bezeroa_manda_id: pilot.bezeroa_manda,
    });
  };
  const handleEzeztatu = (e) => {
    e.preventDefault();

    Inertia.post('/ezeztatu', {
      gidaria_id: pilot.id,
      oferta: pilot.oferta,
      bezeroa_manda_id: pilot.bezeroa_manda,
    });
  };

  return (
    <div className="puja-container">
      <form>
        <div className="balorea">
          <img src={euro} alt="" />
          <p className="puja-value">MERKATU BALOREA</p>
          <p>{pilot?.balioa}</p>
        </div>

        <div className="oferta-valor">
          <p className="oferta-value">OFERTA</p>
          <p>{pilot.oferta}€</p>
        </div>
        <div className="manager-izena">
          <p className="manager-txt">Manager-aren izena</p>
          <p>{pilot.bezeroa_manda_nombre}</p>
        </div>

        <button
  type="button"
  className="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out"
  onClick={handleOnartu}
>
  ✅ Onartu
</button>

<button
  type="submit"
  className="ezeztatubtn hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out ml-2"
  onClick={handleEzeztatu}
>
  ❌ Ezeztatu
</button>
      </form>
    </div>
  );
}

export default Aukerak;
