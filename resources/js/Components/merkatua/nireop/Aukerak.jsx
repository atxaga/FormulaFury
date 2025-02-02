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

  return (
    <div className="puja-container">
      <form>
        <div className="balorea">
          <img src={euro} alt="" />
          <p className="puja-value">MERKATU BALOREA</p>
          <p>{pilot?.balioa}</p>
        </div>

        <div className="balorea">
          <p className="puja-value">Oferta</p>
          <p>{pilot.oferta}</p>
        </div>
        <div className="balorea">
          <p className="puja-value">Manager-aren izena</p>
          <p>{pilot.bezeroa_manda_nombre}</p>
        </div>

        <button type="button" className="button" onClick={handleOnartu}>
          Onartu
        </button>
        <button type="submit" className="button">
          Ezeztatu
        </button>
      </form>
    </div>
  );
}

export default Aukerak;
