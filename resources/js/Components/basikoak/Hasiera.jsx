import '../../../css/style.css';
import fondo from '../../../assets/video/video.mp4';
import logo from '../../../images/logoblanco.png';

function Hasiera() {
  return (
    <>
      <div className='container text-center'>
        <video className="video-background" autoPlay muted loop>
          <source src={fondo} type="video/mp4" />
        </video>
        <div className='logos'>
          <img src={logo} alt="Logo F1 Fury" />
        </div>
        <div className='login mt-4'>

        <a href="/register"> <button className='registrar'><a>SORTU KONTUA</a></button></a><br />
          <a href="/login">
            <button className='login'>
            <a>KONTUA BADUT</a>
            </button>
            </a>
            <a href="/kontugabe">

            <button className='mixed-button'>
            <a>KONTU GABE SARTU</a>
            </button>
            </a>
        </div>
      </div>
    </>
  );
}

export default Hasiera;
