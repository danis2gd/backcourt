import 'slick-carousel';
import 'slick-carousel/slick/slick.less';
import 'slick-carousel/slick/slick-theme.less';
import '../../scss/components/_carousel.scss'

import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Slider from 'react-slick';
import ReactHtmlParser, {processNodes, convertNodeToElement, htmlparser2} from 'react-html-parser';
class NewsSlider extends Component {

    render() {
        const settings = {
            arrows: true,
            autoplay: true,
            centerMode: true,
            dots: true,
            infinite: true,
        };

        return (
            <Slider className="news-slider">
                <Slides />
            </Slider>
        );
    }
}

class Slides extends Component {
    constructor() {
        super();

        // todo: pull from api
        this.state = {
            items: [
                {
                    'title': 'Welcome to Backcourt!',
                    'description': 'test',
                    'imagePath': '/images/news/kobe_fadeaway.jpg',
                },
                {
                    'title': 'Backcourt World Cup<small><strong>(BETA)</strong></small>',
                    'description': 'Battle it out against every nation in the inaugural Backcourt World Championship.',
                    'imagePath': '/images/news/kobe_fadeaway.jpg',
                }
            ]
        }
    }

    render() {
        return (
            this.state.items.map((slide, key) => {
                    return <Slide key={key} title={slide.title} description={slide.description}
                                  imagePath={slide.imagePath}/>;
            })
        )
    }
}

class Slide extends Component {
    render() {
        return (
            <div className="slide news-slide">
                <img src={this.props.imagePath} className="d-block" alt={this.props.title}/>
                <div className="overlay">
                    <div className="overlay-content">
                        <h2>{ReactHtmlParser(this.props.title)}</h2>
                        <p>{ReactHtmlParser(this.props.description)}</p>
                    </div>
                </div>
            </div>
        );
    }
}

ReactDOM.render(<NewsSlider/>, document.getElementById('news-slider'));