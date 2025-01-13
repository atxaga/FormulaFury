import tick from '../../../images/tick.png';
import fernando from '../../../images/fernando.png';

import "../../../css/taldeaOrria/gidaria.css";

function F1gidaria() {
    return (
        <>
            <div className="gidariaDiv">
                <div className="foto">
                    <img src={fernando} alt="Fernando Alonso" />
                </div>
                <div className="datof1">
                    <div className="izena">
                        <p>Fernando Alonso</p>
                    </div>
                    <div className="egoera">
                        <img src={tick} alt="Disponible" />
                    </div>
                </div>
            </div>
        </>
    );
}

export default F1gidaria;
