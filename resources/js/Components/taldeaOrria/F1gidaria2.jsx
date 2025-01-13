import "../../../css/taldeaOrria/gidaria.css"
import tick from '../../../images/tick.png';
import goatifi from '../../../images/goatifi.jpg';

function F1gidaria(){
    return(
        <>
        <div className="gidariaDiv">
            <div className="foto">
                <img src={goatifi} alt="" />
            </div>
            <div className="datof1">
            <div className="izena">
                <p>Goatifi</p>
            </div>
            <div className="egoera">
                <img src={tick} alt="" />
            </div>
            </div>
        </div>
        </>
    );
}
export default F1gidaria;