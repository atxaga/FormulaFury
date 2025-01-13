import "../../../css/taldeaOrria/gidaria.css"
import tick from '../../../images/tick.png';
import antonelli from '../../../images/antonelli.png';

function F2gidaria(){
    return(
        <>
        <div className="gidariaDiv">
            <div className="foto">
                <img src={antonelli} alt="" />
            </div>
            <div className="datof1">
            <div className="izena">
                <p>Antonelli</p>
            </div>
            <div className="egoera">
                <img src={tick} alt="" />
            </div>
            </div>
        </div>
        </>
    );
}
export default F2gidaria;