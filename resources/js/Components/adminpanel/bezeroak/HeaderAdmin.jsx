import fury from '@/../images/logoblanco.png';
import salida from '@/../images/salida.png';

import '@/../css/adminpanel/header.css';

function HeaderAdmin() {
    return (
        <header className="header-admin">
<div className='img' style={{ display: 'flex', justifyContent: 'space-around', alignItems: 'center', width: '80%' }}>
                <a href='/nagusia' style={{textAlign:'left'}}>
                <img src={salida} alt="Salida" className="logo" style={{  width: '14%' }} />
                </a>
                 <img src={fury} alt="Fury" className="logo" style={{ textAlign: 'left', justifyContent: 'left', marginRight: '40%' }} />
                </div>              <nav className="nav-admin">
                {['Liga', 'Gidariak', 'Taldeak', 'Bezeroak'].map((item, index) => {
                    let path = '#'; 
                    let className = ''; 

                    switch (item) {
                        case 'Liga':
                            path = '/adminpanel'; 
                            className = 'nav-link-gidaria'; 
                            break;
                        case 'Gidariak':
                            path = '/admingidariak'; 
                            className = 'nav-link-gidaria';
                            break;
                        case 'Taldeak':
                            path = '/admintaldeak';
                            className = 'nav-link-taldeak'; 
                            break;
                        case 'Bezeroak':
                            path = '/adminbezeroak'; 
                            className = 'nav-link-liga';
                            break;
                        default:
                            break;
                    }

                    return (
                        <a key={index} href={path} className={`nav-link ${className}`}>
                            <span className="nav-bar"></span>
                            <span className="nav-text">{item}</span>
                            <span className="nav-underline"></span>
                        </a>
                    );
                })}
            </nav>
        </header>
    );
}

export default HeaderAdmin;
