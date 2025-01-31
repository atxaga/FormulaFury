import '../../../css/klasifikazioOrria/jokalaria.css';

import flechaabajo from '../../../images/flechaabajo.png';
import lapiz from '../../../images/lapiz.png';

function Total({liga}) {
  return (
    <>
    <div className='totalDiv'>
      <div className='total'>
        <p>Total</p>
        <img src={flechaabajo} alt="" />
        </div>
        <div className='formula'>
        <p>FORMULA FURY</p>
        </div>
      </div>
      <div className="search-container">
        <input
          type="text"
          className="search-input text-white"
          value={liga.deskribapena}
        />
        <button className="search-button">
          <img src={lapiz} alt="Buscar" />
        </button>
      </div>
    </>
  );
}

export default Total;
