#ifndef CHTTPCONTROLLER_H
#define CHTTPCONTROLLER_H

#include <QObject>
#include <QDebug>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include "cjsonparser.h"
#include <QHttpMultiPart>
#include <QHttpPart>
#include <QUrl>

class CHttpController : public QObject
{
	Q_OBJECT
	QNetworkAccessManager* m_manager;
	QNetworkRequest request;
	static CHttpController* ms_instance;
	explicit CHttpController(QObject *parent = nullptr);
	~CHttpController();
public:
	CHttpController(const CHttpController&) = delete;
	CHttpController& operator =(const CHttpController&) = delete;
	static CHttpController* getInstatnce();
	bool POST(const QString&, const QJsonObject&);
	bool GET(const QString&);
signals:
	void finished(QNetworkReply*);
public slots:
	void getResult(QNetworkReply*);
	void getPostRespone(QNetworkReply*);
};

#endif // CHTTPCONTROLLER_H
