import '../../../css/klasifikazioOrria/jokalaria.css';
import perfil from "../../../images/perfil.png";

function Jokalaria({ bezeroak }) {
  return (
    <>
      {bezeroak.map((bezero, index) => (
        <div className='blanco2-liga' key={index}>
          <div className='datuak'>
            <div className='posizioa'>
              <p>{index + 1}</p> 
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
