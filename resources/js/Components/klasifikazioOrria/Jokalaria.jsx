import '../../../css/klasifikazioOrria/jokalaria.css';
import perfil from "../../../images/perfil.png";

function Jokalaria({bezeroak}) {
  return (
    <>

    {bezeroak.map((bezero) => (
      <div className='blanco2-liga'>
      <div className='datuak'>
        <div className='posizioa'>
      <p>1</p>
      <img src={perfil} alt="" />
      </div>
      <div className='usuario'>
      <p className='usuarioIzena'>{bezero.izena}</p>
      <p className='usuarioDirua'>{bezero.dirua}</p>
      </div>
      </div>
      <div className='puntuak'>
        <p className='punto'>{bezero.puntuak}</p><p className='prfy'>PRFY</p>
      </div>
      </div>
    ))}
      
    </>
  );
}

export default Jokalaria;

