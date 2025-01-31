import "../../../css/taldeaOrria/gidaria.css"
import tick from '../../../images/tick.png';
import goatifi from '../../../images/goatifi.jpg';
import perfil from '@/../images/perfilGidari.png'

function F1gidaria({ gidariaF1 }){
    return(
        <>
        <div className="gidariaDiv">
            <div className="foto">
                <img src={gidariaF1.foto} alt="" />
            </div>
            <div className="datof1">
            <div className="izena">
            </div>
            <div className="egoera">
            </div>
            </div>
        </div>
        </>
    );
}
export default F1gidaria;