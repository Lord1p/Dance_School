#include "chttpcontroller.h"

CHttpController* CHttpController::ms_instance;

CHttpController::CHttpController(QObject *parent) : QObject(parent){
	m_manager = new QNetworkAccessManager();
	connect(m_manager,&QNetworkAccessManager::finished,this,&CHttpController::getResult);
	connect(m_manager,&QNetworkAccessManager::finished,this,&CHttpController::getPostRespone);
}

CHttpController::~CHttpController(){
	delete m_manager;
}

CHttpController* CHttpController::getInstatnce(){
	if(!ms_instance){
		ms_instance = new CHttpController();
		struct Eraser{
			~Eraser(){delete ms_instance;}
		};
		static Eraser s_eraser;
	}
	return ms_instance;
}

bool CHttpController::GET(const QString & url){
	request.setUrl(QUrl(url));
	m_manager->get(request);
	return true;
}

bool CHttpController::POST(const QString & url, const QJsonObject& object){
	request.setUrl(QUrl(url));
	QJsonDocument doc(object);
	request.setHeader(QNetworkRequest::ContentTypeHeader, "application/x-www-form-urlencoded");
	auto text = doc.toJson();
	m_manager->post(request,doc.toJson());
	return true;
}

void CHttpController::getResult(QNetworkReply* reply){
	if (reply->error()) {
		qDebug() << reply->errorString();
		return;
	}
	QString answer = reply->readAll();
	CJsonParser::getParser()->setData(answer);
}

void CHttpController::getPostRespone(QNetworkReply* reply){
	qDebug() << reply->readAll();
}
