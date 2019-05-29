#include "chttpcontroller.h"

CHttpController* CHttpController::ms_instance;

CHttpController::CHttpController(QObject *parent) : QObject(parent){
	m_manager = new QNetworkAccessManager();
	connect(m_manager,&QNetworkAccessManager::finished,this,&CHttpController::printResult);
	qDebug("Create successfuly!");
}

CHttpController::~CHttpController(){
	delete m_manager;
	qDebug("Delete successfuly!");
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

void CHttpController::printResult(QNetworkReply* reply){
	if (reply->error()) {
		qDebug() << reply->errorString();
		return;
	}
	QString answer = reply->readAll();
	qDebug() << answer;
}
