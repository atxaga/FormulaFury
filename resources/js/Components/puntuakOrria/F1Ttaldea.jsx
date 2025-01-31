import "../../../css/taldeaOrria/gidaria.css"
import ferrari from '../../../images/ferrari.png';

function F1taldea(){
    return(
        <>
        <div className="gidariaDiv">
            <div className="escuderia">
                <img src={ferrari} alt="" />
            </div>
            <div className="datof1">
            <div className="izena">
                <p>Scuderia Ferrari</p>
            </div>
            </div>
        </div>
        </>
    );
}
export default F1taldea;