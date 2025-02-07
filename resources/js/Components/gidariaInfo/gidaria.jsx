import dispo from '@/../images/tick.png'
import euro from '@/../images/euro.png'
import '@/../css/gidariaInfo/gidaria.css'
import { useEffect, useState } from 'react'



function Gidaria({gidaria, puntuak, posizioak}){
    
    const [puntuakGidaria, setPuntuakGidaria] = useState([]);
    const [posizioakGidaria, setPosizioaGidaria] = useState([]);
    console.log(puntuakGidaria, posizioakGidaria);
    useEffect(() => {
        if (puntuak) {
            puntuak.map((puntua) => {
                if (puntua.id === gidaria.id) {
                    setPuntuakGidaria(puntua);
                }
            })
        }
        
        if (posizioak) {
            
            posizioak.map((posizioa) => {
                
                if (posizioa.id === gidaria.id) {
                    
                    setPosizioaGidaria(posizioa);
                }
            })
        }
    },[gidaria, puntuak, posizioak])
    return(
        <>
        <div className="gidaria-inf">
                <div className='gida'>
                <div className="gidaria-img">
                        <img src={gidaria.foto} alt="" />
                    </div>
                    <div className="gidaria-datuak">
                        <div className='gidariIzena'>
                        <div className='motaGidari'>
                            <p>PIL</p>
                        </div>
                        <p className="izena">{gidaria.izena}</p>

                    </div>
                        <div className='dispo'>
                            <img src={dispo} alt="" />
                            <p>Disponible</p>
                        </div>
                        <div className='baloreaGid'>
                            <img src={euro} alt="" />
                            <p>{gidaria.balioa}</p>
                        </div>
                    </div>
                    
                    <div className='gidaria-puntuak'>
                        <div className='gid-punt'>
                        <p className='pfry'>PFRY </p> <p>{puntuakGidaria.puntuak_guztira}</p>
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
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.pos_race}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Lasterketa posizioa</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.pos_race}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        <tr>
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.pos_qualy}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Klasifikazio posizioa</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.pos_qualy}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        <tr>
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.h2h_qualy}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Taldekide aurretik klasifikazioan</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.h2h_qualy}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        <tr>
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.h2h_race}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Taldekide aurretik Lasterketan</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.h2h_race}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        <tr>
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.buelta_azkarra}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Buelta azkarra</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.buelta_azkarra}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        <tr>
                            {posizioakGidaria ? (
                                <td className="orange">{posizioakGidaria.pole}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                            <td className="white">Pole</td>
                            {puntuakGidaria ? (
                                <td className="orange">{puntuakGidaria.pole}</td>
                            ) : (
                                <td className="orange">-</td>
                            )}
                        </tr>
                        

                    </tbody>
                </table>
                <hr />
            </div>
        </>
    )
}
export default Gidaria;