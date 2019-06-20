#ifndef CJSONPARSER_H
#define CJSONPARSER_H

#include <QObject>
#include <QJsonObject>
#include <QJsonArray>
#include <QJsonDocument>
#include <QString>
#include <QStringList>
#include <QDebug>

class CJsonParser : public QObject
{
	Q_OBJECT
	CJsonParser();
	~CJsonParser();
	QJsonObject data;
	QStringList dataList;
	static CJsonParser* parserInst;
public:
	static CJsonParser* getParser();
	void setData(const QString&);
	const QJsonObject& getData() const {return data; }
	const QStringList& getDataList(const QString&,const QString&);
	QString findData(const QString&,const QString&,const QString&);
signals:
	void dataModified();
public slots:
};

#endif // CJSONPARSER_H
