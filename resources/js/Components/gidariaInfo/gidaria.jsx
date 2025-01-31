import dispo from '@/../images/tick.png'
import euro from '@/../images/euro.png'
function Gidaria({gidaria}){
    return(
        <>
        <div className="gidaria-inf">
            <div className="gidaria-img">
                <img src={gidaria.foto} alt="" />
            </div>
            <div className="gidaria-datuak">
                <p>{gidaria.izena}</p>
                <div className='dispo'>
                    <img src={dispo} alt="" />
                    <p>Disponible</p>
                </div>
                <div className='balorea'>
                    <img src={euro} alt="" />
                    <p>{gidaria.balioa}</p>
                </div>
            </div>
            <div className='gidaria-puntuak'>
                <p>PFRY 0</p>
                <p>Media 0.0</p>
            </div>
            <input type="button" value="Saldu" className='saldu' />
        </div>
        <div className='puntuak'>
            <p>Info gabe</p>
        </div>
        <div className='puntuaketa-sistema'>
            
        </div>
        </>
    )
}