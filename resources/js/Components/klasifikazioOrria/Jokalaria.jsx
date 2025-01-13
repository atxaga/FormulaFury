import '../../../css/klasifikazioOrria/jokalaria.css';
import perfil from "../../../images/perfil.png";

function Jokalaria() {
  return (
    <>
      <div className='blanco2-liga'>
        <div className='datuak'>
          <div className='posizioa'>
        <p>1</p>
        <img src={perfil} alt="" />
        </div>
        <div className='usuario'>
        <p className='usuarioIzena'>macacopeleon</p>
        <p className='usuarioDirua'>560.000.000</p>
        </div>
        </div>
        <div className='puntuak'>
          <p className='punto'>570</p><p className='prfy'>PRFY</p>
        </div>
        </div>
    </>
  );
}

export default Jokalaria;

