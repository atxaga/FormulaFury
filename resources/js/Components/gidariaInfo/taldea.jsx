import dispo from '@/../images/tick.png'
import euro from '@/../images/euro.png'
import '@/../css/gidariaInfo/gidaria.css'



function Taldea({taldea}){
    return(
        <>
        <div className="gidaria-inf">
                <div className='gida'>
                <div className="gidaria-img">
                        <img src={taldea.foto} alt="" />
                    </div>
                    <div className="gidaria-datuak">
                        <div className='gidariIzena'>
                        <div className='motaGidari'>
                            <p>PIL</p>
                        </div>
                        <p className="izena">{taldea.izena}</p>

                    </div>
                        <div className='dispo'>
                            <img src={dispo} alt="" />
                            <p>Disponible</p>
                        </div>
                        <div className='baloreaGid'>
                            <img src={euro} alt="" />
                            <p>{taldea.balioa}</p>
                        </div>
                    </div>
                    
                    <div className='gidaria-puntuak'>
                        <div className='gid-punt'>
                        <p className='pfry'>PFRY </p> <p>0</p>
                        </div>
                        <div className='gid-punt'>
                        <p className='pfry'>MEDIA </p> <p>0.0</p>
                        </div>
                        <input type="button" value="Saldu" className='saldu' />

                        </div>
                        <div>
                        </div>
                </div>
            </div>
            <div className='puntuaketa'>
                <p>Info gabe</p>
            </div>
            <div className='puntuaketa-sistema'>
                <h2>1. LASTERKETA</h2>
                <table>
                    <tbody>
                        <tr className="header-row">
                            <td>KANTITATEA</td>
                            <td>ESTATISTIKAK</td>
                            <td>PUNTUAK</td>
                        </tr>
                        <tr>
                            <td className="white">-</td>
                            <td className="white">Lasterketa posizioa</td>
                            <td className="orange">-</td>
                        </tr>
                        <tr>
                            <td className="white">-</td>
                            <td className="white">Klasifikazio posizioa</td>
                            <td className="orange">-</td>
                        </tr>
                        <tr>
                            <td className="white">-</td>
                            <td className="white">Buelta azkarra</td>
                            <td className="orange">-</td>
                        </tr>
                        <tr>
                            <td className="white">-</td>
                            <td className="white">Pole</td>
                            <td className="orange">-</td>
                        </tr>
                        <tr>
                            <td className="white">-</td>
                            <td className="white">Pit stop</td>
                            <td className="orange">-</td>
                        </tr>

                    </tbody>
                </table>
                <hr />
            </div>
        </>
    )
}
export default Taldea;