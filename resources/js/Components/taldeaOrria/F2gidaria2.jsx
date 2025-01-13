import "../../../css/taldeaOrria/gidaria.css"
import tick from '../../../images/tick.png';
import bearman from '../../../images/bearman.png';

function F2gidaria(){
    return(
        <>
        <div className="gidariaDiv">
            <div className="foto">
                <img src={bearman} alt="" />
            </div>
            <div className="datof1">
            <div className="izena">
                <p>Bearman</p>
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